// SHOW & HIDE FILTERS IN MAIN PAGE
function showFilters()
{
    var showfiltersbutton = document.getElementById("show-filters");
    var hidefiltersbutton = document.getElementById("hide-filters");
    var filtersform = document.getElementById("filters-form");

    filtersform.style.display = "block";
    showfiltersbutton.style.display = "none";
    hidefiltersbutton.style.display = "block";
    filtersform.style.animation = "show-filters 1s 1";
}

function hideFilters()
{
    var showfiltersbutton = document.getElementById("show-filters");
    var hidefiltersbutton = document.getElementById("hide-filters");
    var filtersform = document.getElementById("filters-form");

    filtersform.style.display = "none";
    hidefiltersbutton.style.display = "none";
    showfiltersbutton.style.display = "block";
}
var showfiltersbutton = document.getElementById("show-filters");
showfiltersbutton.addEventListener('click', showFilters, false);
var hidefiltersbutton = document.getElementById("hide-filters");
hidefiltersbutton.addEventListener('click', hideFilters, false);

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
    
    if(postnavsub.style.display === "block")
        {
            postnavsub.style.display = "none";
        }
    else
        {
            postnavsub.style.display = "block";
            postnavsub.style.animation = "post-nav-sub 1s 1";
        }
}

var postnav = document.getElementById("post-nav");
postnav.addEventListener('click', postSubMenu, false);
