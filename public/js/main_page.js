const loadHaiku = (page = 1, order = "newest", ammount = 10, author = 0) => {
    const haikuBox = document.getElementById("haiku_box");
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const haikuData = JSON.parse(request.responseText);
            //console.log(haikuData);
            if(haikuData[0] !== false)
            {
                if(haikuData[1] == 0) haikuBox.innerHTML = "No haiku to show!";
                else
                {
                    haikuData[2].forEach(singleHaiku => {
                        haikuPosts.push(new Haiku(
                            singleHaiku['id'],
                            singleHaiku['author'],
                            singleHaiku['country'],
                            singleHaiku['title'],
                            singleHaiku['content'],
                            singleHaiku['content_native'],
                            singleHaiku['likes'],
                            false,
                            singleHaiku['background'],
                            singleHaiku['handwriting'],
                            false
                        ));
                    });

                    haikuBox.innerHTML = "";

                    haikuPosts.forEach(haikuObject => {
                        haikuObject.generate();
                        haikuObject.showOnWebsite("haiku_box");
                    });
                }
            }
            else
            {
                haikuBox.innerHTML = haikuData[1];
            }   
        }
    };
    request.open("POST", "../resources/haiku_load.php", true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(
        "page="+page+"&"+
        "order="+order+"&"+
        "ammount="+ammount+"&"+
        "author="+author
    );
};

const reportHaiku = (id) => {
    const ReportBox = document.getElementById("post-report-menu");
    ReportBox.style.display = "block";
    ReportBox.style.animation = "show-element 0.5s 1";
    reporting = id;
};

// EVENT LISTERNERS
document.getElementById("post-report-close").addEventListener("click", () => {
    document.getElementById("post-report-menu").style.display = "none";
    reporting = null;
});

let haikuPosts = [];
let reporting = null;

window.onload = () => {
    loadHaiku();
};