const showAuthors = () => {
    Loading(true);
    const loadAuthors = new XMLHttpRequest();
    loadAuthors.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const loadReady = JSON.parse(this.responseText);
        if(loadReady[0] == true)
        {
            const tableResponse1 = document.getElementById('table-response1');
            const tableResponse2 = document.getElementById('table-response2');
            let count = 0;
            loadReady[1].forEach(author => {
                const tr = document.createElement("tr");
                const td1 = document.createElement("td");
                const td2 = document.createElement("td");
                tr.setAttribute("title", "Click to see author haiku.");
                tr.setAttribute("class", "trAll");
                td1.innerHTML = author['fname'];
                td2.innerHTML = author['country'];
                td1.addEventListener("click", () => {
                showAuthorsHaiku(author['id'], author['fname'], author['country']);
                });
                td2.addEventListener("click", () => {
                showAuthorsHaiku(author['id'], author['fname'], author['country']);
                });
                const editBtn = document.createElement("div");
                editBtn.setAttribute("class", "author-edit");
                editBtn.setAttribute("title", "Click to edit author.");
                editBtn.addEventListener("click", () => {
                editAuthor(author['id'], author['firstname'], author['surname'], author['country']);
                });
                if(count%2 == 0)
                {
                    tableResponse1.appendChild(tr);
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(editBtn);
                }
                else
                {
                    tableResponse2.appendChild(tr);
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(editBtn);
                }       
                count = count + 1;
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
    loadAuthors.open("POST","../resources/author_search.php",true);
    loadAuthors.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    loadAuthors.send('search=');
};

window.onload = showAuthors;

const showAuthorsHaiku = (id, fname, country) => {
    let data = JSON.stringify([id, fname, country]);
    console.log(data);
    sessionStorage.setItem("author", data);
    window.location.href = "index.php";
};

const editAuthor = (id, fname, sname, country) => {
    document.getElementById('add-new-author').style.display = "block";
    document.getElementById('add-new-author').style.animation = "show-element 0.5s";
    document.getElementById('author-firstname').value = fname;
    document.getElementById('author-surname').value = sname;
    document.getElementById('author-country').value = country;
    const editSubmit = document.getElementById('author-submit');

    editSubmit.addEventListener("click", () => {
        event.preventDefault();
        sendAuthor(id);
        });
};

const sendAuthor = (id) => {
    const firstname = document.getElementById('author-firstname').value;
    const surname = document.getElementById('author-surname').value;
    const country = document.getElementById('author-country').value;
    Loading(true);
    const loadAuthors = new XMLHttpRequest();
    loadAuthors.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const loadReady = JSON.parse(this.responseText);
        showCommunicate(loadReady);
        Loading(false);
        const trAll = document.querySelectorAll('.trAll').forEach(tr => tr.remove());
        document.getElementById('add-new-author').style.display = "none";
        showAuthors();
      }
    };
    loadAuthors.open("POST","../resources/author_edit.php",true);
    loadAuthors.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    loadAuthors.send('id='+id+"&"+"name="+firstname+"&"+
    "surname="+surname+"&"+
    "country="+country);
};

function hideEditAuthor()
{
    document.getElementById("add-new-author").style.display = "none";
}
const addNewMenuClose = document.getElementById("add-new-author-close");
addNewMenuClose.addEventListener('click', hideEditAuthor, false);