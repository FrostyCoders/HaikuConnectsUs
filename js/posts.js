// LIKE POKAZOWE TRZEBA Z POMOCA PHP ZROBIC
function likeIt()
{
    var like = document.getElementById("post-like");
    var likecounteradd = document.getElementById("post-like-counter").getAttribute("data-value");
    likecounteradd = parseInt(likecounteradd)+1;
    var likecounter = document.getElementById("post-like-counter");
    
    like.style.backgroundImage = "url('img/icons/heart_full_normal.svg')";
    likecounter.innerHTML = likecounteradd;
    
    like.style.animation = "like-it 1s 1";
}

var like = document.getElementById("post-like");
like.addEventListener('click', likeIt, false);

// SUBMENU W POSTACH
function postSubMenu()
{
    var postnavsub = document.getElementById("post-nav-sub");
    var load = document.getElementById("loading-container");
    
    if(postnavsub.style.display === "block")
        {
            postnavsub.style.display = "none";
        }
    else
        {
            postnavsub.style.display = "block";
            postnavsub.style.animation = "show-element 1s 1";
            load.style.display = "block";
        }
}

var postnav = document.getElementById("post-nav");
postnav.addEventListener('click', postSubMenu, false);

// REPORT POSTA
function reportPost()
{
    var postreport = document.getElementById("post-report-menu");
    postreport.style.display = "block";
    postreport.style.animation = "show-element 0.5s 1";
}

var postreport = document.getElementById("post-nav-sub-option-report");
postreport.addEventListener('click', reportPost, false);

// ZAMKNIĘCIE REPORTA POSTA
function reportPostClose()
{
    var postreport = document.getElementById("post-report-menu");
    postreport.style.display = "none";
}

var postreportclose = document.getElementById("post-report-close");
postreportclose.addEventListener('click', reportPostClose, false);