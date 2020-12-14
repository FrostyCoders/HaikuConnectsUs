const showAuthors = () => {
    Loading(true);
    const checkLogin = new XMLHttpRequest;
    checkLogin.onreadystatechange = () => {
        if(checkLogin.readyState == 4 && checkLogin.status == 200) {
            adminLogged = JSON.parse(checkLogin.responseText)
            Loading(false);
        }
    };
    checkLogin.open("POST","../resources/author_checker.php",true);
    checkLogin.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    checkLogin.send('check=');

    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if(request.readyState == 4 && request.status == 200) 
        {
            const loadReady = JSON.parse(request.responseText);
            if(loadReady[0] == true)
            {
                const tables = [document.getElementById('table-response1')];
                tables.forEach(element => {
                    element.innerHTML = "";
                });

                loadReady[1].forEach(author => {
                    const tr = document.createElement("tr");
                    tr.setAttribute("class", "trAll");
                    tr.innerHTML = "<td>" + author['fname'] + "</td><td>" + author['country'] + "</td>";
                
                    if(adminLogged == true)
                    {
                        tr.setAttribute("title", "Click to show author haiku or edit author.");
                        tr.addEventListener("click", () => {
                            editAuthor(author['id'], author['fname'], author['firstname'], author['surname'], author['country']);
                        });
                    }
                    else
                    {
                        tr.setAttribute("title", "Click to show haiku.");
                        tr.addEventListener("click", () => {
                            showAuthorsHaiku(author['id'], author['fname'], author['country']);
                        });
                    }
                    tables[0].appendChild(tr);
                });
            }
            else
            {
                const tableBox = document.getElementById('table-box');
                tableBox.innerHTML = '<p class="load-error">Error, cannot load haiku authors!</p>';
            }
            Loading(false);
        }
    };
    request.open("POST","../resources/author_search.php",true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send('search=');
};

const showAuthorsHaiku = (id, fname, country) => {
    let data = JSON.stringify([id, fname, country]);
    sessionStorage.setItem("author", data);
    window.location.href = "index.php";
};

const editAuthor = (id, fullname, fname, sname, country) => {
    const add_new_author = document.getElementById('add-new-author');
    add_new_author.style.display = "block";
    add_new_author.style.animation = "show-element 0.5s";
    document.getElementById('author-firstname').value = fname;
    document.getElementById('author-surname').value = sname;
    document.getElementById('author-country').value = country;

    document.getElementById('add_author_form').addEventListener("submit", (event) => {
        event.preventDefault();
        sendEditedAuthor(id);
    });

    document.getElementById('author-show-haiku').addEventListener("click", () => {
        showAuthorsHaiku(id, fullname, country);
    });
};

const sendEditedAuthor = (id) => {
    id = parseInt(id);
    const firstname = document.getElementById('author-firstname').value;
    const surname = document.getElementById('author-surname').value;
    const country = document.getElementById('author-country').value;
    Loading(true);
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200) {
            const response = JSON.parse(request.responseText);
            showCommunicate(response);
            if(response[0] == true)
            {
                document.querySelectorAll('.trAll').forEach(tr => tr.remove());
                document.getElementById('add-new-author').style.display = "none";
                showAuthors();
            }
            Loading(false);
        }
    };
    request.open("POST","../resources/author_edit.php",true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send('id='+id+"&"+"name="+firstname+"&"+
    "surname="+surname+"&"+
    "country="+country);
};

document.getElementById("add-new-author-close").addEventListener('click', () => {
    document.getElementById("add-new-author").style.display = "none";
}, false);

// MAIN
window.onload = showAuthors();