// SHOW & HIDE FILTERS IN MAIN PAGE
function showFilters()
{
    var showfiltersbutton = document.getElementById("show-filters");
    var hidefiltersbutton = document.getElementById("hide-filters");
    var filtersform = document.getElementById("filters-form");

    filtersform.style.display = "block";
    showfiltersbutton.style.display = "none";
    hidefiltersbutton.style.display = "block";
    filtersform.style.animation = "show-element 1s 1";
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