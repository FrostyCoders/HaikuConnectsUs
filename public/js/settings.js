// CHANGE NICKNAME
function changeNickname()
{
    const nicknameNew = document.getElementById("change-nickname").value;
    const nicknameOld = document.getElementById("settings-nickname").textContent;
    let nicknameConfirm = document.getElementById("confirm-nickname");
    let nicknameNotification = document.getElementById("nickname-notification");
    
    nicknameNotification.style.display = "block";
    nicknameNotification.textContent = "The nickname is available";
    nicknameNotification.style.color = "#000000";
    nicknameConfirm.style.display = "block";
    
    if(nicknameNew == nicknameOld)
        {
            nicknameNotification.textContent = "Nicknames are the same";
            nicknameNotification.style.color = "#ff0000";
        }
    
    //Tak samo ze sprawdzaniem z bazą czy jest już taki
    //if()
       
    if(nicknameNew.length < 1)
        {
            nicknameNotification.style.display = "none";
            nicknameConfirm.style.display = "none";
        }
}

document.getElementById("change-nickname").addEventListener("keyup", changeNickname, false);

// CHANGE EMAIL
function changeEmail()
{
    const emailNew = document.getElementById("change-email").value;
    const emailOld = document.getElementById("settings-email").textContent;
    let emailConfirm = document.getElementById("confirm-email");
    let emailNotification = document.getElementById("email-notification");
    
    emailNotification.style.display = "block";
    emailNotification.textContent = "The email is available";
    emailNotification.style.color = "#000000";
    emailConfirm.style.display = "block";
    
    if(emailNew == emailOld)
        {
            emailNotification.textContent = "Emails are the same";
            emailNotification.style.color = "#ff0000";
        }
    
    //Tak samo ze sprawdzaniem z bazą czy jest już taki
    //if()
       
    if(emailNew.length < 1)
        {
            emailNotification.style.display = "none";
            emailConfirm.style.display = "none";
        }
}

document.getElementById("change-email").addEventListener("keyup", changeEmail, false);

// CHANGE PASSWORD
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

document.getElementById("check-password").addEventListener("keyup", changePassword, false);
document.getElementById("change-password").addEventListener("keyup", changePassword, false);
document.getElementById("repeat-password").addEventListener("keyup", changePassword, false);
