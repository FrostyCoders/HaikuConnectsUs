const Loading = (state) => {
    const loadContainer = document.getElementById("loading-container");
    const container = document.getElementById("points-loading-container");
    const frame = document.getElementsByClassName("frame")[0];
    if(state == true)
    {
        container.style.bottom = "35%";
        container.style.right = "20%";
     
        container.style.display = "block";
        frame.style.pointerEvents = "none";
        frame.style.filter = "blur(8px)";
    }
    else
    {
        container.style.display = "none";
        frame.style.pointerEvents = "all";
        frame.style.filter = "none";
    }
};

const ShowResult = (Message) => {
    const PageResult = document.getElementById("page_result");
    if(Message[0] == true) PageResult.style.color = "black";
    else PageResult.style.color = "red";

    PageResult.textContent = Message[1];
    PageResult.style.display = "block";

    if(Message[0] == false)
    {
        PageResult.animate([
            { transform: 'translateX(-45%) translateY(-50%)' }, 
            { transform: 'translateX(-55%) translateY(-50%)' },
            { transform: 'translateX(-50%) translateY(-50%)' }
          ], { 
            duration: 100,
            iterations: 3
          });
    }
};

document.getElementById("forgot_button").addEventListener("click", () => {
    const LoginForm = document.getElementById("login_form");
    const ForgotForm = document.getElementById("forgot_form");
    LoginForm.style.opacity = "0";
    document.getElementById("page_result").textContent = "";
    setTimeout( () => {
        LoginForm.style.display = "none";
        ForgotForm.style.display = "block";
    }, 350);
    setTimeout( () => {
        ForgotForm.style.opacity = "1";
    }, 350);
});

document.getElementById("back_button").addEventListener("click", () => {
    const LoginForm = document.getElementById("login_form");
    const ForgotForm = document.getElementById("forgot_form");
    ForgotForm.style.opacity = "0";
    document.getElementById("page_result").textContent = "";
    setTimeout( () => {
        ForgotForm.style.display = "none";
        LoginForm.style.display = "block";
    }, 350);
    setTimeout( () => {
        LoginForm.style.opacity = "1";
    }, 350);
});

document.getElementById("login_form").addEventListener("submit", (event) => {
    event.preventDefault();
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {   
            const RequestResult = JSON.parse(this.responseText);
            if(RequestResult[0] == true) window.location.href = "index.php";
            else ShowResult(RequestResult);
        }
    };

    request.open("POST", "../resources/user_login.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("email="+email+"&password="+password);
});

document.getElementById("forgot_form").addEventListener("submit", (event) => {
    event.preventDefault();
    Loading(true);
    const email = document.getElementById("account_email").value;
    const request = new XMLHttpRequest();

    request.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {   
            Loading(false);
            ShowResult(JSON.parse(this.responseText));
        }
    };

    request.open("POST", "../resources/user_pass_request.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("email="+email);
});