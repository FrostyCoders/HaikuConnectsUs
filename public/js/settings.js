// CHECK NICKNAME
document.getElementById("change-nickname").addEventListener("keyup", () => {
    const nicknameNew = document.getElementById("change-nickname").value;
    const nicknameConfirm = document.getElementById("confirm-nickname");
    const nicknameNotification = document.getElementById("nickname-notification");
    
    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const nickname = JSON.parse(request.responseText);
            switch(nickname[0])
            {
                case 0:
                {
                    nicknameNotification.style.display = "none";
                    nicknameConfirm.style.display = "none";
                    showCommunicate([false, nickname[1]]);
                    break;
                }
                case 1:
                {
                    nicknameNotification.style.display = "block";
                    nicknameNotification.textContent = nickname[1];
                    nicknameNotification.style.color = "#000000";
                    nicknameConfirm.style.display = "block";
                    break;
                }
                case 2:
                {
                    nicknameNotification.style.display = "block";
                    nicknameNotification.textContent = nickname[1];
                    nicknameNotification.style.color = "#ff0000";
                    nicknameConfirm.style.display = "none";
                    break;
                }
                default:
                {
                    nicknameNotification.style.display = "none";
                    nicknameConfirm.style.display = "none";
                    break;
                }
            }
            Loading(false);
            if(nicknameNew.length < 1)
            {
                nicknameNotification.style.display = "none";
                nicknameConfirm.style.display = "none";
            }
        }
    };
    request.open("POST", "../resources/user_nickname_checker.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
        "nickname="+nicknameNew
    );
}, false);

document.getElementById("form-nickname").addEventListener("submit", (event) => {
    event.preventDefault();
    const nicknameNew = document.getElementById("change-nickname").value;
    const nicknameSettings = document.getElementById("settings-nickname");
    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const nickname = JSON.parse(request.responseText);
            if(nickname[0] == true)
                nicknameSettings.textContent = nicknameNew;

            showCommunicate(nickname);
            Loading(false);
        }
    };
    request.open("POST", "../resources/user_nickname_change.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
        "nickname="+nicknameNew
    );
});

// CHECK EMAIL
document.getElementById("change-email").addEventListener("keyup", () => {
    const emailNew = document.getElementById("change-email").value;
    const emailConfirm = document.getElementById("confirm-email");
    const emailNotification = document.getElementById("email-notification");

    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const email = JSON.parse(request.responseText);
            switch(email[0])
            {
                case 0:
                {
                    emailNotification.style.display = "none";
                    emailConfirm.style.display = "none";
                    showCommunicate([false, email[1]]);
                    break;
                }
                case 1:
                {
                    emailNotification.style.display = "block";
                    emailNotification.textContent = email[1];
                    emailNotification.style.color = "#000000";
                    emailConfirm.style.display = "block";
                    break;
                }
                case 2:
                {
                    emailNotification.style.display = "block";
                    emailNotification.textContent = email[1];
                    emailNotification.style.color = "#ff0000";
                    emailConfirm.style.display = "none";
                    break;
                }
                default:
                {
                    emailNotification.style.display = "none";
                    emailConfirm.style.display = "none";
                    break;
                }
            }
            Loading(false);
            if(emailNew.length < 1)
            {
                emailNotification.style.display = "none";
                emailConfirm.style.display = "none";
            }
        }
    };
    request.open("POST", "../resources/user_email_checker.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
        "email="+emailNew
    );
}, false);

document.getElementById("form-email").addEventListener("submit", (event) => {
    event.preventDefault();
    const newMail = document.getElementById("change-email").value;
    const request = new XMLHttpRequest;
    Loading(true);
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const response = JSON.parse(request.responseText);
            Loading(false);
            showCommunicate(response);
        }
    };

    request.open("POST", "../resources/user_email_request.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
        "new_email="+newMail
    );
});

// CHECK PASSWORD
function checkPassword()
{
    const passwordOld = document.getElementById("check-password").value;
    const passwordNew = document.getElementById("change-password").value;
    const passwordNewRepeat = document.getElementById("repeat-password").value;
    const passwordNotification = document.getElementById("password-notification");
    const passwordChecker = document.querySelector(".password-checker");
    const passwordConfirm = document.getElementById("confirm-password");

    const strengthMarks = [
        document.getElementById("password-weak"),
        document.getElementById("password-medium"),
        document.getElementById("password-strong")
    ];

    if(passwordNew != "")
    {
        passwordChecker.style.display = "flex";
        passwordNotification.style.display = "block";
    }
    else
    {
        passwordChecker.style.display = "none";
        passwordNotification.style.display = "none";
    }

    let passLength = passwordNew.length;
    let checkWeak = Boolean(passwordNew.match(/[A-Z]/));
    let checkMedium = Boolean(passwordNew.match(/[0-9]/));
    let checkStrong = Boolean(passwordNew.match(/[~,`,!,@,#,$,%,^,&,*,(,),-,+,\[,\],\{,\},\:,\;,\',\",=,_,?,\/,<,>,\\,|,\.,\,]/));
    let passPoints = 0;

    strengthMarks.forEach(element => {
        element.style.backgroundColor = "#777";
    });

    if(passLength <= 3)
        passPoints = 0;
    else if(passLength > 3 && passLength < 8)
        passPoints = 1;
    else if (passLength >= 8)
        passPoints = 2;

    if(checkWeak)
        passPoints++;
    
    if(checkMedium)
        passPoints++;
    
    if(checkStrong)
        passPoints+=2;

    if(passPoints <= 2)
    {
        passwordNotification.textContent = "New password is weak";
        strengthMarks[0].style.backgroundColor = "#dd3050";
    }
    
    if(passPoints > 2 && passPoints < 6)
    {
        passwordNotification.textContent = "New password is medium";
        strengthMarks[0].style.backgroundColor = "#dd3050";
        strengthMarks[1].style.backgroundColor = "#dd3050";
    }

    if(passPoints >= 6)
    {
        passwordNotification.textContent = "New password is strong";
        strengthMarks.forEach(element => {
            element.style.backgroundColor = "#dd3050";
        });
    }

    passwordConfirm.style.display = "none";

    if(passwordNew != passwordNewRepeat && passwordNewRepeat != "")
        passwordNotification.textContent = "Entered passwords are diffrent!";
    else if(passwordNew == passwordOld)
        passwordNotification.textContent = "New password must be diffrent than old password!";
    else if(passPoints >= 6 && passwordNewRepeat == passwordNew)
        passwordConfirm.style.display = "block";
}

document.getElementById("form-pass").addEventListener("submit", (event) => {
    event.preventDefault();
    const inputs = [
        document.getElementById("check-password"),
        document.getElementById("change-password"),
        document.getElementById("repeat-password")
    ];
    
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const response = JSON.parse(request.responseText);
            if(response[0] == true)
            {
                inputs.forEach(element => {
                    element.value = "";
                });
            }
            showCommunicate(response);
        }
    };

    request.open("POST", "../resources/user_pass_logged.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
        "current="+inputs[0].value+"&"+
        "pass1="+inputs[1].value+"&"+
        "pass2="+inputs[2].value
    );
});

document.getElementById("check-password").addEventListener("keyup", checkPassword, false);
document.getElementById("change-password").addEventListener("keyup", checkPassword, false);
document.getElementById("repeat-password").addEventListener("keyup", checkPassword, false);
