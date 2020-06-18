function showhidefilters()
{
    var showfiltersbutton = document.getElementById("show-filters");
    var hidefiltersbutton = document.getElementById("hide-filters");
    var filtersform = document.getElementById("filters-form");

    filtersform.style.display = "block";
    showfiltersbutton.style.display = "none";
    hidefiltersbutton.style.display = "block";
    filtersform.style.animation = "show-filters 1s 1";
}
var showfiltersbutton = document.getElementById("show-filters");
showfiltersbutton.addEventListener('click', showhidefilters, false);

function hidehidefilters()
{
    var showfiltersbutton = document.getElementById("show-filters");
    var hidefiltersbutton = document.getElementById("hide-filters");
    var filtersform = document.getElementById("filters-form");

    filtersform.style.display = "none";
    hidefiltersbutton.style.display = "none";
    showfiltersbutton.style.display = "block";
}
var showfiltersbutton = document.getElementById("show-filters");
showfiltersbutton.addEventListener('click', showhidefilters, false);
var hidefiltersbutton = document.getElementById("hide-filters");
hidefiltersbutton.addEventListener('click', hidehidefilters, false);