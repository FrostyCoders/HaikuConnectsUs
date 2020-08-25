// CHECK NICKNAME
function changeNickname()
{
    const nicknameNew = document.getElementById("change-nickname").value;
    const nicknameConfirm = document.getElementById("confirm-nickname");
    const nicknameNotification = document.getElementById("nickname-notification");
    
    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const nickname = JSON.parse(request.responseText);
            if(nickname[0] == 1)
            {
                    nicknameNotification.style.display = "block";
                    nicknameNotification.textContent = nickname[1];
                    nicknameNotification.style.color = "#000000";
                    nicknameConfirm.style.display = "block";
            }
            else if(nickname[0] == 2)
            {
                    nicknameNotification.style.display = "block";
                    nicknameNotification.textContent = nickname[1];
                    nicknameNotification.style.color = "#ff0000";
                    nicknameConfirm.style.display = "none";
            }
            else if(nickname[0] == 0)
            {
                    nicknameNotification.style.display = "none";
                    nicknameConfirm.style.display = "none";
                    showCommunicate([false, nickname[1]]);
            }
            else
            {
                    nicknameNotification.style.display = "none";
                    nicknameConfirm.style.display = "none";
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
}

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

document.getElementById("change-nickname").addEventListener("keyup", changeNickname, false);

// CHECK EMAIL
function checkEmail()
{
    const emailNew = document.getElementById("change-email").value;
    const emailConfirm = document.getElementById("confirm-email");
    const emailNotification = document.getElementById("email-notification");

    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const email = JSON.parse(request.responseText);
            if(email[0] == 1)
            {
                    emailNotification.style.display = "block";
                    emailNotification.textContent = email[1];
                    emailNotification.style.color = "#000000";
                    emailConfirm.style.display = "block";
            }
            else if(email[0] == 2)
            {
                    emailNotification.style.display = "block";
                    emailNotification.textContent = email[1];
                    emailNotification.style.color = "#ff0000";
                    emailConfirm.style.display = "none";
            }
            else if(email[0] == 0)
            {
                    emailNotification.style.display = "none";
                    emailConfirm.style.display = "none";
                    showCommunicate([false, email[1]]);
            }
            else
            {
                    emailNotification.style.display = "none";
                    emailConfirm.style.display = "none";
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
}

document.getElementById("form-email").addEventListener("submit", (event) => {
    event.preventDefault();
    const newMail = document.getElementById("change-email").value;
    const request = new XMLHttpRequest;
    Loading(true);
    
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            console.log(request.responseText);
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

document.getElementById("change-email").addEventListener("keyup", checkEmail, false);

// CHECK PASSWORD
function checkPassword()
{
    const passwordOld = document.getElementById("check-password").value;
    const passwordNew = document.getElementById("change-password").value;
    const passwordNewRepeat = document.getElementById("repeat-password").value;
    const passwordConfirm = document.getElementById("confirm-password");
    const passwordNotification = document.getElementById("password-notification");
    const passwordChecker = document.querySelector(".password-checker");
    const weak = document.getElementById("password-weak");
    const medium = document.getElementById("password-medium");
    const strong = document.getElementById("password-strong");

    let checkWeak = /[a-zA-Z]/;
    let checkMedium = /[0-9]/;
    let checkStrong = /[~,`,!,@,#,$,%,^,&,*,(,),-,+,\[,\],\{,\},\:,\;,\',\",=,_,?,\/,<,>,\\,|,\.,\,]/;
    let num = 0;
    
    if(passwordNew != ""){
        passwordChecker.style.display = "flex";
    }
    else{
        passwordChecker.style.display = "none";
        passwordNotification.style.display = "none";
    }

    if(passwordNew.length <=3 && (passwordNew.match(checkWeak) || passwordNew.match(checkMedium) || passwordNew.match(checkStrong))){
        num = 1;
    }

    if(passwordNew.length >=3 && ((passwordNew.match(checkWeak) && passwordNew.match(checkMedium)) || (passwordNew.match(checkMedium) && passwordNew.match(checkStrong)) || (passwordNew.match(checkWeak) && passwordNew.match(checkStrong)))){
        num = 2;
    }

    if(passwordNew.length >=8 && (passwordNew.match(checkWeak) && passwordNew.match(checkMedium) && passwordNew.match(checkStrong))){
        num = 3;
    }
    
    if(num == 1){
        passwordNotification.style.display = "block";
        passwordNotification.textContent = "New password is weak";
        weak.style.backgroundColor = "#dd3050";
    }

    if(num == 2){
        passwordNotification.style.display = "block";
        passwordNotification.textContent = "New password is medium";
        medium.style.backgroundColor = "#dd3050";
    }
    else{
        medium.style.backgroundColor = "#777";
    }

    if(num == 3){
        passwordNotification.style.display = "block";
        passwordNotification.textContent = "New password is strong";
        medium.style.backgroundColor = "#dd3050";
        strong.style.backgroundColor = "#dd3050";
    }
    else{
        strong.style.backgroundColor = "#777";
    }

    if((num == 3 && passwordNew != passwordOld && passwordNew == passwordNewRepeat) && (passwordOld.length>=1 && passwordNewRepeat.length>=1 && passwordNew.length>=1)){
        passwordConfirm.style.display = "block";
    }
    else{
        passwordConfirm.style.display = "none";
    }
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
            console.log(request.responseText);
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
