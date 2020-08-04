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
                // tutaj jeszcze blad do boxa z bledem
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
});

document.getElementById("change-nickname").addEventListener("keyup", changeNickname, false);

// CHECK EMAIL
function changeEmail()
{
    const emailNew = document.getElementById("change-email").value;
    const emailConfirm = document.getElementById("confirm-email");
    const emailNotification = document.getElementById("email-notification");
    
    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            console.log(request.responseText);
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
                // tutaj jeszcze blad do boxa z bledem
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
});

document.getElementById("change-email").addEventListener("keyup", changeEmail, false);

// CHECK PASSWORD
function changePassword()
{
    const passwordOld = document.getElementById("check-password").value;
    const passwordNew = document.getElementById("change-password").value;
    const passwordNewRepeat = document.getElementById("repeat-password").value;
    let passwordConfirm = document.getElementById("confirm-password");
    let passwordNotification = document.getElementById("password-notification");
    
    let passwordArray = new Array();
    passwordArray.push("[A-Z]");
    passwordArray.push("[a-z]");
    passwordArray.push("[0-9]");
    passwordArray.push("[$@$!%*#?&]");
    
    passwordNotification.style.visibility = "visible";
    passwordNotification.textContent = "Write the new password";
    passwordNotification.style.color = "#ff0000";
    passwordConfirm.style.display = "none";
    
    // SPRAWDZIC CZY HASLO SIE Z BAZA ZGADZA
    
    if(passwordNew.length<1 && passwordOld.length<1 && passwordNewRepeat.length<1)
        {
            passwordNotification.textContent = "Write the new password";
            passwordNotification.style.color = "#ff0000";
        }
    
    else if(passwordNew == passwordOld)
        {
            passwordNotification.textContent = "Old password and new are the same";
            passwordNotification.style.color = "#ff0000";
            passwordConfirm.style.display = "none";
        }
    
    else if(passwordNew.length>=1 && passwordNew != passwordOld)
        {
            let passed = 0;

            for (let i = 0; i < passwordArray.length; i++) 
            {
                if (new RegExp(passwordArray[i]).test(passwordNew)) 
                {
                    passed++;
                }
            }

            if (passed > 2 && passwordNew.length > 8) 
            {
                passed++;
            }

            let color = "";
            let strength = "";
            switch (passed) 
            {
                case 0:
                case 1:
                    strength = "Weak";
                    color = "ff0000";
                    break;
                case 2:
                    strength = "Good";
                    color = "#e57702";
                    break;
                case 3:
                case 4:
                    strength = "Strong";
                    color = "#05b225";
                    break;
                case 5:
                    strength = "Very Strong";
                    color = "#07a301";
                    break;
            }
            passwordNotification.textContent = strength;
            passwordNotification.style.color = color;
            
            if((passwordNew.length>=8 && passwordNewRepeat.length>=8) && (passwordNew.length==passwordNewRepeat.length) && (passwordNew == passwordNewRepeat) && passwordNew != passwordOld)
               {
                    passwordConfirm.style.display = "block";
               }
        }
}

document.getElementById("form-pass").addEventListener("submit", (event) => {
    event.preventDefault();
});

document.getElementById("check-password").addEventListener("keyup", changePassword, false);
document.getElementById("change-password").addEventListener("keyup", changePassword, false);
document.getElementById("repeat-password").addEventListener("keyup", changePassword, false);
