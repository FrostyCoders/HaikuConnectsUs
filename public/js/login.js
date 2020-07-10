window.onload = function()
{
    var loginWindow = document.getElementById("window");
    var info = document.getElementById("info");
    var form = document.getElementById("form");
    loginWindow.style.width = "650px";
    setTimeout(function(){
        info.style.opacity = "1";
    }, 700);
    setTimeout(function(){
        form.style.opacity = "1";
    }, 1200);
};

document.getElementsByClassName("cookies_button")[0].addEventListener("click", function(){
    var button = document.getElementsByClassName("cookies_button")[0];
    var cookie_info = document.getElementsByClassName("cookies_info")[0];
    button.style.bottom = "-50px";
    cookie_info.style.bottom = "5px";
});

document.getElementById("close_info").addEventListener("click", function(){
    var button = document.getElementsByClassName("cookies_button")[0];
    var cookie_info = document.getElementsByClassName("cookies_info")[0];
    button.style.bottom = "-5px";
    cookie_info.style.bottom = "-50px";
});

document.getElementsByClassName("forgot")[0].addEventListener("click", function(){
    var login = document.getElementById("login");
    var forget = document.getElementById("forget_pass");
    login.style.opacity = "0";
    setTimeout(function(){
        forget.style.display = "block";
        login.style.display = "none";
    },500);
    setTimeout(function(){
        forget.style.opacity = "1";
    },600);
});
document.getElementsByClassName("back_login")[0].addEventListener("click", function(){
    var login = document.getElementById("login");
    var forget = document.getElementById("forget_pass");
    forget.style.opacity = "0";
    setTimeout(function(){
        login.style.display = "block";
        forget.style.display = "none";
    },500);
    setTimeout(function(){
        login.style.opacity = "1";
    },600);
});

// LOGIN 
document.getElementById("login_button").addEventListener("click", function(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var result = document.getElementById("request_result_login");
    var request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            var request_result = JSON.parse(this.responseText);
            if(request_result[0] == false)
            {
                result.innerHTML = request_result[1];
            }
            else
            {
                window.location.href = "main_page.html";
            }
        }
    };
    request.open("POST", "../resources/user_login.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("email="+email+"&password="+password);
});

// FORGOT PASSWORD
document.getElementById("forgot_button").addEventListener("click", function(){
    var email = document.getElementById("recover_email").value;
    var result = document.getElementById("request_result_forgot");
    if(email.length == 0)
    {
        result.innerHTML = "Enter email!";
    }
    else
    {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                request_result = JSON.parse(this.responseText);
                if(request_result[0] == false)
                {
                    result.style.color = "red";
                }
                else
                {
                    result.style.color = "black";
                }
                result.innerHTML = request_result[1];
              }
        };
        request.open("POST", "../resources/user_pass_request.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("email="+email);
    }
});
