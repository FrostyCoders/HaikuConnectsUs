document.getElementById("change_pass_form").addEventListener("submit", (event) => {
    event.preventDefault();
    const pass1 = document.getElementById("new_pass").value;
    const pass2 = document.getElementById("repeated_pass").value;
    const pageResult = document.getElementById("page_result");
    if(pass1.length == 0 || pass2.length == 0)
    {
        ShowResult([false, "Error, enter both passwords!"]);
    }
    else
    {
        Loading(true);  
        const request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                pageResult.textContent = "";
                const response = JSON.parse(this.responseText);
                if(response[0] == true)
                {
                    const frame = document.getElementById("change_pass_form");
                    let change = document.createElement('p');
                    change.setAttribute("class", "notification");
                    change.innerHTML = response[1];
                    frame.parentNode.replaceChild(change, frame);
                }
                else
                {
                    ShowResult(response);
                }
                Loading(false);
            }
        };
        request.open("POST", "../resources/user_pass_change.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("pass1="+pass1+"&pass2="+pass2);
    }
});