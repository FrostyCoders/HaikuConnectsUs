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
        showCommunicate([false, "Fill all inputs in add author form!"]);
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
                    hideAddNewAuthor();
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

function showCommunicate(message) {
    if(message[1].length == 0)
        return ;
    const box = document.getElementById("post-error");
    box.textContent = message[1];
    box.style.display = "block";
    new Promise((resolve, reject) => {
        if(message[0] == false)
            box.style.color = "red";
        else
            box.style.color = "var(--dark-color)";
        resolve();
    }).then(() => {
        if(message[0] == false)
        {
            box.animate([
                { transform: 'translateX(-45%)' },
                { transform: 'translateX(-55%)' },
                { transform: 'translateX(-50%)' }
            ], {
                duration: 100,
                iterations: 3
            });
        }
        else
        {
            box.animate([
                { top: "6rem" }, 
                { top: "6.5rem" }
            ], {
                duration: 300,
                iterations: 1
            });
        }
    }).then(() => {
        setTimeout(() => {
            box.style.display = "none";
        }, 5000);
    });
};

// <!--- ADD NEW HAIKU ---!>
const addHaikuFrom = document.getElementById("haiku_data");
addHaikuFrom.addEventListener("submit", (event) => {
    event.preventDefault();
    Loading(true);
    const content = document.getElementById("in-english").value;
    const contentNative = document.getElementById("in-native").value;
    if(selectedAuthor == 0)
        showCommunicate([false, "Select haiku author!"]);
    else if(content.length == 0)
        showCommunicate([false, "Haiku text in english is required!"]);
    else
    {
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
            }
        };

        request.open("POST","../resources/haiku_add.php",true);
        request.send(formData);
    }
});

let selectedAuthor = 0;