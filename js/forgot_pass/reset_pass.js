document.getElementById("send").addEventListener("click", function(){
    var email = document.getElementById("email").value;
    var result = document.getElementById("request_result");
    if(email.length == 0)
    {
        result.innerHTML = "Enter email!";
    }
    else
    {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                result.innerHTML = this.responseText;
              }
        };
        request.open("POST", "php/private/pass_request.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("email="+email);
    }
    
});