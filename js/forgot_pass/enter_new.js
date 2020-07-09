document.getElementById("change").addEventListener("click", function(){
    var pass1 = document.getElementById("new_pass").value;
    var pass2 = document.getElementById("repeated_pass").value;
    var result = document.getElementById("request_result_reset");
    var frame = document.getElementsByClassName("frame")[0];
    if(pass1.length == 0 || pass2.length == 0)
    {
        result.innerHTML = "Enter both passwords!";
    }
    else
    {
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
                    frame.innerHTML = request_result[1];
                }
              }
        };
        request.open("POST", "../resources/user_pass_change.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("pass1="+pass1+"&pass2="+pass2);
    }
});