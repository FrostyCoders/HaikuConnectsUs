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
const loadHaiku = (page = 1, order = "newest", ammount = 10, grid = 2, author = 0) => {
    Loading(true);
    const haikuBox = document.getElementById("haiku_box");
    const request = new XMLHttpRequest;
    request.onreadystatechange = () => {
        if (request.readyState == 4 && request.status == 200)
        {
            const haikuData = JSON.parse(request.responseText);
            if(haikuData[0] !== false)
            {
                if(haikuData[1] == 0) 
                    haikuBox.innerHTML = '<p class="load-error">Error, cannot load haiku data!</p>';
                else
                {
                    haikuPosts = [];
                    const likedPosts = JSON.parse(localStorage.getItem("likes"));
                    const reportedPosts = JSON.parse(sessionStorage.getItem("reports"));
                    let gridClass = "mg-posts";
                    switch(grid)
                    {
                        case "1":
                            {
                                gridClass = "mg-posts1";
                                break;
                            }
                        case "2":
                            {
                                gridClass = "mg-posts";
                                break;
                            }
                        case "3":
                            {
                                gridClass = "mg-posts3";
                                break;
                            }
                        default:
                            {
                                gridClass = "mg-posts";
                                break;
                            }
                    }
                    haikuData[2].forEach(singleHaiku => {
                        haikuPosts.push(new Haiku(
                            singleHaiku['id'],
                            singleHaiku['author'],
                            singleHaiku['country'],
                            singleHaiku['content'],
                            singleHaiku['content_native'],
                            singleHaiku['likes'],
                            checkArray(likedPosts, singleHaiku['id']),
                            singleHaiku['bg'],
                            singleHaiku['hw'],
                            checkArray(reportedPosts, singleHaiku['id']),
                            gridClass,
                            adminLogged
                        ));
                    });

                    haikuBox.innerHTML = "";

                    haikuPosts.forEach(haikuObject => {
                        haikuObject.generate();
                        haikuObject.showOnWebsite("haiku_box");
                    });
                }
                generatePages(currentPage, haikuData[1]);
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
    sortInput.forEach(input => {
        if(input.checked == true) order = input.value; 
    });
        
    const gridInput = document.getElementsByName("posts_grid");
    gridInput.forEach(input => {
        if(input.checked == true) grid = input.value;   
    });

    switch(grid)
    {
        case "1":
        {
            ammount = 6;
            break;
        }
        case "2":
        {
            ammount = 10;
            break;
        }
        case "3":
        {
            ammount = 12;
            break;
        }
        default:
        {
            ammount = 10;
            break;
        }
    }

    currentPage = 1;

    loadHaiku(currentPage, order, ammount, grid, selectedAuthor);
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
    if(reporting == null) showCommunicate([false, "Error occured, refresh site and try again!"]);
    else
    {
        const reportReason = document.getElementsByName("text-report")[0].value;
        const email = document.getElementsByName("guest-email")[0].value;
        if((reportReason.length == 0) || (email.length == 0)){
            showCommunicate([false, "Fill all inputs!"]);
            Loading(false);
        } 
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
            if(reported == false) showCommunicate([false, "Error, cannot find haiku to report, refresh site and try again!"]);
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

// <!--- PAGES ---!>
const changePage = (page) => {
    currentPage = page;
    loadHaiku(currentPage, order, ammount, grid, selectedAuthor);
};

const generatePages = (cPage, pageAmmount) => {
    const previous = document.getElementById("previous_button");
    const next = document.getElementById("next_button");
    const pageNumber = document.querySelector("#page_number a");

    if(cPage > 1 && pageAmmount > 1)
    {
        previous.style.display = "block";
        previous.addEventListener("click", () => {
            changePage(cPage - 1);
        });
    }
    else
    {
        previous.style.display = "none";
    }

    if(pageAmmount != 0)
    {
        pageNumber.textContent = cPage + "/" + pageAmmount;
        pageNumber.style.display = "block";
    }   

    if(cPage < pageAmmount && pageAmmount > 1)
    {
        next.style.display = "block";
        next.addEventListener("click", () => {
            changePage(cPage + 1);
        });
    }
    else
    {
        next.style.display = "none";
    }

    if(pageAmmount == 0)
    {
        previous.style.display = "none";
        next.style.display = "none";
        pageNumber.style.display = "none";
    }
};

// <!--- MAIN ---!>
let haikuPosts = [];
let reporting = null;
let selectedAuthor = 0;
let currentPage = 1;
let order = "newest";
let grid = 2;
let ammount = 10;

window.onload = () => {
    checkStorage();
    if((sessionStorage.getItem("author") !== null))
    {
        author = JSON.parse(sessionStorage.getItem("author"));
        selectedAuthor = author[0];
        setAuthorFilter(author[0], author[1] + ", " + author[2]);
        sessionStorage.removeItem("author");
    }
    loadHaiku(currentPage, order, ammount, grid, selectedAuthor);
};

// COOKIE ALERT
function cookieAlert(name,value,time){
    let cookieTime = "";
    if (time){
        let date = new Date();
        date.setTime(date.getTime() + (time*24*60*60*99999));
        cookieTime = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + cookieTime + "; path=/";
}

if (document.cookie.indexOf("cookie_alert=") < 0) {
    const cookieAlertBar = document.getElementById("cookie-alert-close");

    cookieAlertBar.addEventListener('click', function() {
    document.getElementById("cookie-alert").style.display = "none";
    cookieAlert('cookie_alert','1',1);
    });
}