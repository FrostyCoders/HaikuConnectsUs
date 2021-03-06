// <!--- AUTHOR FILTER ---!>
document.getElementById("author").addEventListener("focusin", () => {
    document.getElementById("author_list").style.display = "block";
    document.getElementById("author").value = "";
    selectedAuthor = 0;
});

document.getElementById("author").addEventListener("focusout", () => {
    setTimeout(() => {
        document.getElementById("author_list").style.display = "none";
    }, 100);
});

document.getElementById("author").addEventListener("keyup", () => {
    let phrase = document.getElementById("author").value;
    phrase = phrase.charAt(0).toUpperCase() + phrase.slice(1);
    document.getElementById("author").value = phrase;
    searchAuthor();
});

const searchAuthor = () => {
    const phrase = document.getElementById("author").value;
    const list = document.getElementById("author_list");
    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const authorsList = JSON.parse(request.responseText);
            list.innerHTML = "";
            if(authorsList[0] == true)
            {
                list.innerText = "";
                authorsList[1].forEach(author => {
                    let li = document.createElement("li");
                    li.textContent = author['fname'] + ", " + author['country'];
                    li.addEventListener("click", () => {
                        setAuthorFilter(author['id'], author['fname'] + ", " + author['country']);
                    });
                    list.appendChild(li);
                });
            }
            else
            {
                let message = document.createElement("li");
                message.textContent = authorsList[1];
                list.appendChild(message);
            }
            const addAuthor = document.createElement("li");
            addAuthor.setAttribute("id", "add-author");
            addAuthor.textContent = "Add new author";
            addAuthor.addEventListener("click", () => {
                const addNewMenu = document.getElementById("add-new-author");
                addNewMenu.style.display = "block";
                addNewMenu.style.animation = "show-element 0.5s 1";
            });
            list.appendChild(addAuthor);
            Loading(false);
        }
    };
    request.open("POST", "../resources/author_search.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
        "search="+phrase
    );
};

const setAuthorFilter = (id, data) => {
    selectedAuthor = id;
    document.getElementById("author").value = data;
};

// <!--- ADD NEW AUTHOR ---!>

document.getElementById("add_author_form").addEventListener("submit", (event) => {
    event.preventDefault();
    Loading(true);
    const firstName = document.getElementById("author-firstname").value;
    const surName = document.getElementById("author-surname").value;
    const country = document.getElementById("author-country").value;
    if(firstName.length == 0 || surName.length == 0 || country.length == 0)
    {
        showCommunicate([false, "Error, fill all inputs in add author form!"]);
        return 0;
    }
    else
    {
        const request = new XMLHttpRequest;
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                const response = JSON.parse(request.responseText);
                if(response[0] == true)
                {
                    document.getElementById("add-new-author").style.display = "none";
                    setAuthorFilter(response[2], firstName + " " + surName + ", " + country);
                }
                showCommunicate(response);
                Loading(false);
            };
        };

        request.open("POST","../resources/author_add.php",true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(
            "name="+firstName+"&"+
            "surname="+surName+"&"+
            "country="+country
        );
    }
    document.getElementById("add_author_form").reset();
});

// <!--- ADD NEW HAIKU ---!>
const addHaikuFrom = document.getElementById("haiku_data");

const addNewHaiku = (event) => {
    event.preventDefault();
    const content = document.getElementById("in-english").value;
    const contentNative = document.getElementById("in-native").value;
    if(selectedAuthor == 0)
        showCommunicate([false, "Error, select haiku author!"]);
    else if(content.length == 0)
        showCommunicate([false, "Error, haiku text in english is required!"]);
    else
    {
        Loading(true);
        let formData = new FormData(addHaikuFrom);
        formData.set("author", selectedAuthor);
        formData.set("content", JSON.stringify(content.split('')));
        formData.set("content_native", JSON.stringify(contentNative.split('')));
        const request = new XMLHttpRequest;
        request.onreadystatechange = () => {
            if (request.readyState == 4 && request.status == 200) {
                const response = JSON.parse(request.responseText);
                if(response[0] == true)
                    addHaikuFrom.reset();

                showCommunicate(response);
                Loading(false);

                const fileComplete = document.getElementById("file-complete");
                document.getElementById('background-name').style.display = "none";
                document.getElementById("post-header").style.backgroundImage = "url(img/other/background.jpg";
                fileComplete.textContent = "Upload background";
                fileComplete.style.borderColor = "#353330";
                fileComplete.style.color = "#353330";
            }
        };

        request.open("POST","../resources/haiku_add.php",true);
        request.send(formData);
    }
};

// <!--- EDIT HAIKU ---!>

const sendEdited = (event) => {
    event.preventDefault();
    const content = document.getElementById("in-english").value;
    const contentNative = document.getElementById("in-native").value;
    if(selectedAuthor == 0)
        showCommunicate([false, "Error, select haiku author!"]);
    else if(content.length == 0)
        showCommunicate([false, "Error, haiku text in english is required!"]);
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
                const response = JSON.parse(request.responseText);  

                showCommunicate(response);
                Loading(false);
            }
        };

        request.open("POST","../resources/haiku_edit.php",true);
        request.send(formData);
    }
};

const deleteImage = (which) => {
    if(confirm("Are you sure, image will be deleted pernamently!") == true)
    {
        Loading(true);
        const request = new XMLHttpRequest;
        request.onreadystatechange = () => {
            if(request.readyState == 4 && request.status == 200)
            {
                const response = JSON.parse(request.responseText)
                if(response[0] == true)
                {
                    switch(which)
                    {
                        case "bg":
                        {
                            deleteBackground();
                            break;
                        }
                        case "hw":
                        {
                            deleteHandwriting();
                            break;
                        }
                        default:
                        {
                            break;
                        }
                    }
                }
                showCommunicate(response);
                Loading(false);
            }
        }
        request.open("POST", "../resources/img_delete.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("hid="+editingHaiku+"&image="+which);
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

                liveAuthorHaiku();


                if (haikuData[7] != "default.png"){
                    const fileComplete = document.getElementById("file-complete");
                    fileComplete.textContent = "Image choosed";
                    fileComplete.style.borderColor = "#2da333";
                    fileComplete.style.color = "#2da333";
                    
                }
                if(haikuData[6] != null)
                {
                    document.getElementById("lang-switch").style.display = "block";
                }
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

let editingHaiku = 0;
let selectedAuthor = 0;

addHaikuFrom.addEventListener("submit", addNewHaiku, false);

window.onload = () => {
    if(sessionStorage.getItem("toEdit") !== null)
    {
        editingHaiku = sessionStorage.getItem("toEdit");
        enterData(editingHaiku);
    }
}