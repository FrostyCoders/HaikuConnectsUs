const sendEdited = (event) => {
    event.preventDefault();
    const content = document.getElementById("in-english").value;
    const contentNative = document.getElementById("in-native").value;
    if(selectedAuthor == 0)
        showCommunicate([false, "Select haiku author!"]);
    else if(content.length == 0)
        showCommunicate([false, "Haiku text in english is required!"]);
    else
    {
        Loading(true);
        let formData = new FormData(addHaikuFrom);
        formData.set("haiku_id", editingHaiku);
        formData.set("haiku_author", selectedAuthor);
        formData.set("haiku_content", JSON.stringify(content.split('')));
        formData.set("haiku_c_native", JSON.stringify(contentNative.split('')));
        const request = new XMLHttpRequest;
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                console.log(request.responseText);
                const response = JSON.parse(request.responseText);
                if(response[0] == true)
                {
                    addHaikuFrom.reset();
                    setTimeout(() => {
                        window.location.href = "index.php";
                    }, 500);
                }   

                showCommunicate(response);
                Loading(false);
            }
        };

        request.open("POST","../resources/haiku_edit.php",true);
        request.send(formData);
    }
};

const changeContent = () => {
    document.getElementsByClassName("display-4")[0].textContent = "Edit exsisting Haiku!";
    document.getElementsByClassName("my-4 font-weight-light")[0].textContent = "Below is the editor to edit existing haiku with live preview.";
    document.querySelector(".add-inputs h4").textContent = "Editing Form";
    const form = document.getElementById("haiku_data");
    form.removeEventListener("submit", addNewHaiku);
    form.addEventListener("submit", sendEdited);
    document.getElementById("add-haiku-button").value = "Edit Haiku";
};

const enterData = (id) => {
    const request = new XMLHttpRequest;

    request.onreadystatechange = () => {
        if(request.readyState == 4 && request.status == 200)
        {
            const response = JSON.parse(request.responseText);
            if(response[0] == true)
            {
                changeContent();
                haikuData = response[1];
                editingHaiku = haikuData[0];
                selectedAuthor = haikuData[1];
                document.getElementById("author").value = haikuData[2] + " " + haikuData[3] + ", " + haikuData[4];
                document.getElementById("in-english").value = haikuData[5];
                document.getElementById("in-native").value = haikuData[6];
                document.getElementById("post-header").style.backgroundImage = "url(../uploads/background/" + haikuData[7] + ")";
                document.getElementById("post-nav-handwriting").style.backgroundImage = "url(../uploads/handwriting/" + haikuData[8] + ")";
            }
            else
            {
                showCommunicate(response);
            }
        }
    };

    request.open("POST", "../resources/haiku_load_edit.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send("haiku_id="+id);

}

// MAIN

window.onload = () => {
    if(sessionStorage.getItem("toEdit") !== null)
    {
        editingHaiku = sessionStorage.getItem("toEdit");
        enterData(editingHaiku);
        sessionStorage.removeItem("toEdit");
    }
}

let editingHaiku = 0;