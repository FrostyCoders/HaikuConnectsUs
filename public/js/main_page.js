// <!--- USER SESSION ---!>
const checkStorage = () => {
    if (localStorage.getItem("likes") === null) {
        localStorage.setItem("likes", JSON.stringify([]));
    }
    
    if (sessionStorage.getItem("reports") === null) {
        sessionStorage.setItem("reports", JSON.stringify([]));
    }
};

const saveLikesData = (value, mode) => {
    let data = JSON.parse(localStorage.getItem("likes"));
    value = String(value);
    if(mode == "add")
    {
        data.push(value);
        localStorage.setItem("likes", JSON.stringify(data));
    }
    else if(mode == "remove")
    {
        let newData = [];
        data.forEach(element => {
            if(element != value)
            {
                newData.push(element);
            }
        });
        localStorage.setItem("likes", JSON.stringify(newData));
    }
    else
    {
        throw new Error("Error, undefined function mode!");
        return;
    }
};

const saveReportsData = (value) => {
    let data = JSON.parse(sessionStorage.getItem("reports"));
    value = String(value);
    data.push(value);
    sessionStorage.setItem("reports", JSON.stringify(data));
};

// <!--- HAIKU LOADING ---!>
const loadHaiku = (page = 1, order = "newest", ammount = 10, author = 0) => {
    Loading(true);
    const haikuBox = document.getElementById("haiku_box");
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const haikuData = JSON.parse(request.responseText);
            if(haikuData[0] !== false)
            {
                if(haikuData[1] == 0) haikuBox.innerHTML = '<div class="notification">No haiku to show!</div>';
                else
                {
                    haikuPosts = [];
                    const likedPosts = JSON.parse(localStorage.getItem("likes"));
                    const reportedPosts = JSON.parse(sessionStorage.getItem("reports"));
                    haikuData[2].forEach(singleHaiku => {
                        haikuPosts.push(new Haiku(
                            singleHaiku['id'],
                            singleHaiku['author'],
                            singleHaiku['country'],
                            singleHaiku['title'],
                            singleHaiku['content'],
                            singleHaiku['content_native'],
                            singleHaiku['likes'],
                            checkArray(likedPosts, singleHaiku['id']),
                            singleHaiku['bg'],
                            singleHaiku['hw'],
                            checkArray(reportedPosts, singleHaiku['id'])
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
            Loading(false);
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

// <!--- AUTHOR FILTER ---!>
document.getElementById("author_input").addEventListener("focusin", () => {
    document.getElementById("author_list").style.display = "block";
    document.getElementById("author_input").value = "";
    selectedAuthor = 0;
    getFilters();
});

document.getElementById("author_input").addEventListener("focusout", () => {
    setTimeout(() => {
        document.getElementById("author_list").style.display = "none";
    }, 100);
});

document.getElementById("author_input").addEventListener("keyup", () => {
    let phrase = document.getElementById("author_input").value;
    phrase = phrase.charAt(0).toUpperCase() + phrase.slice(1);
    document.getElementById("author_input").value = phrase;
    searchAuthor();
});

const searchAuthor = () => {
    const phrase = document.getElementById("author_input").value;
    const list = document.getElementById("author_list");
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
    document.getElementById("author_input").value = data;
    getFilters();
};

// <!--- OTHER FILTERS ---!>

document.querySelectorAll("input[type='radio']").forEach(filter => {
    filter.addEventListener("change", () => {
        getFilters();
    });
});

const getFilters = () => {
    const sortInput = document.getElementsByName("sort");
    let sortValue = "newest";
    sortInput.forEach(input => {
        if(input.checked == true) sortValue = input.value; 
    });
        
    const quantInput = document.getElementsByName("quantity");
    let quantValue = "10";
    quantInput.forEach(input => {
        if(input.checked == true) quantValue = input.value;
    });

    loadHaiku(currentPage, sortValue, quantInput, selectedAuthor);
};

// <!--- REPORT ---!>
const showReportHaiku = (id) => {
    const ReportBox = document.getElementById("post-report-menu");
    ReportBox.style.display = "block";
    ReportBox.style.animation = "show-element 0.5s 1";
    reporting = id;
};

document.getElementById("post-report-close").addEventListener("click", () => {
    document.getElementById("post-report-menu").style.display = "none";
    document.getElementById("report_form").reset();
    reporting = null;
});

document.getElementById("report_form").addEventListener("submit", (event) => {
    event.preventDefault();
    Loading(true);
    if(reporting == null) console.log("Error occured, refresh site and try again!");
    else
    {
        const reportReason = document.getElementsByName("text-report")[0].value;
        const email = document.getElementsByName("guest-email")[0].value;
        if((reportReason.length == 0) || (email.length == 0)) console.log("Fill all inputs!");
        else
        {
            let reported = false;
            const showResult = (result) => {
                showCommunicate(result);
            };
            haikuPosts.forEach(post => {
                if(post.id == reporting)
                {
                    post.report(email, reportReason, showResult);
                    reported = true;
                }
            });
            if(reported == false) console.log("Error, cannot find haiku to report, refresh site and try again!");
            else
            {
                document.getElementById("post-report-menu").style.display = "none";
                reporting = null;
            }
            Loading(false);
        }
    }
    document.getElementById("report_form").reset();
});

// <!--- COMMUNICATES---!>
const showCommunicate = (message) => {
    if(message[1].length == 0)
        return ;
    const box = document.getElementById("page-communicate");
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

// <!--- LIKES ---!>


// <!--- MAIN ---!>
let haikuPosts = [];
let reporting = null;
let selectedAuthor = 0;
let currentPage = 1;

window.onload = () => {
    checkStorage();
    loadHaiku();
};