window.onload = () => {
    Loading(true);
    const loadAuthors = new XMLHttpRequest();
    loadAuthors.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        const loadReady = JSON.parse(this.responseText);
        if(loadReady[0] == true)
        {
            const tableResponse = document.getElementById('table-response');
            loadReady[1].forEach(author => {
                const tr = document.createElement("tr");
                tr.setAttribute("title", "Click to see author haiku.");
                tr.innerHTML = '<td>'+author['fname']+'</td><td>'+author['country']+'</td>';
                tr.addEventListener("click", () => {
                    showAuthorsHaiku(author['id'], author['fname'], author['country']);
                });
                tableResponse.appendChild(tr);
            });
        }
        else
            console.log("Cannot load haiku authors!");
        Loading(false);
      }
    };
    loadAuthors.open("POST","../resources/author_search.php",true);
    loadAuthors.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    loadAuthors.send('search=');
}

const showAuthorsHaiku = (id, fname, country) => {
    let data = JSON.stringify([id, fname, country]);
    console.log(data);
    sessionStorage.setItem("author", data);
    window.location.href = "index.php";
};