// CHANGE AUTHOR ON LIVE
function liveAuthorHaiku()
{    
    var authorName = document.getElementById("author").value;
    var postAuthor = document.getElementById("post-author");
    //var country = document.getElementById("country").value;
    var postCountry = document.getElementById("post-country");
    //postCountry.textContent = country;
    
    if(authorName.length <= 1)
        {
            postAuthor.textContent = ".";
            postAuthor.style.visibility = "hidden";
        }
    else
        {
            postAuthor.textContent = authorName;
            postAuthor.style.visibility = "visible";
        }
    
    liveCheckEnter();
}

liveAuthorHaiku();

// CHANGE HAIKU POST ON LIVE
function liveCheckEnter()
{
    var inEnglish = document.getElementById("in-english").value;
    var inNative = document.getElementById("in-native").value;
    var postHaiku = document.getElementById("post-haiku");
    var isChecked = document.getElementById("ischecked").checked;
    var isCheckedSwitch = document.getElementById("lang-switch");
   
    var inEnglishArray = Array.from(inEnglish);
    var inNativeArray = Array.from(inNative);
    
    postHaiku.textContent = "";
    
    if(inNative.length < 1)
        {
            isCheckedSwitch.style.display = "none";
        }
    else
        {
            isCheckedSwitch.style.display = "block";
        }
    
    if(isChecked == false)
        {
            if(inEnglish.length < 1)
                {
                    postHaiku.innerHTML = "<br />";
                }
            inEnglishArray.forEach(element => {
            if(element.charCodeAt(0) == 10)
                {
                    postHaiku.innerHTML += "<br />";
                }
            else
                {
                    postHaiku.innerHTML += element;
                }
            });
        }
    else if(isChecked == true)
        {
            if(inNative.length < 1)
                {
                    postHaiku.innerHTML = "<br />";
                }
            inNativeArray.forEach(element => {
            if(element.charCodeAt(0) == 10)
                {
                    postHaiku.innerHTML += "<br />";
                }
            else
                {
                    postHaiku.innerHTML += element;
                }
            });
        }

    setTimeout(liveAuthorHaiku, 1000);
} 

// CHANGE BACKGROUND ON LIVE
var pullFileBackground = function()
{ 
    var fileInput = document.querySelector("#background-haiku");
    var fileComplete = document.getElementById("file-complete");
    
    var reader = new FileReader();
    reader.onload = function()
    {
        var postHeader = document.getElementById("post-header"); 
        postHeader.style.backgroundImage = 'url('+reader.result+')';
        fileComplete.textContent = "Upload successfully";
        fileComplete.style.borderColor = "#2da333";
        fileComplete.style.color = "#2da333";
    }
    
    reader.readAsDataURL(fileInput.files[0]);
}

var pullFileHandwriting = function()
{ 
    var fileInputHand = document.querySelector("#handwriting-haiku");
    var fileCompleteHand = document.getElementById("file-complete-hand");
    
    var reader = new FileReader();
    reader.onload = function()
    {
        var postHeaderHead = document.getElementById("post-nav-handwriting"); 
        postHeaderHead.style.backgroundImage = 'url('+reader.result+')';
        fileCompleteHand.textContent = "Upload successfully";
        fileCompleteHand.style.borderColor = "#2da333";
        fileCompleteHand.style.color = "#2da333";
    }
    
    reader.readAsDataURL(fileInputHand.files[0]);
}

document.querySelector("#background-haiku").onchange=pullFileBackground;
document.querySelector("#handwriting-haiku").onchange=pullFileHandwriting;


// ADD NEW AUTHOR

const addAuthor = document.getElementById("add-author");
const addNewMenuClose = document.getElementById("add-new-author-close");

function showAddNewAuthor()
{
    const addNewMenu = document.getElementById("add-new-author");
    addNewMenu.style.display = "block";
    addNewMenu.style.animation = "show-element 0.5s 1";
}
addAuthor.addEventListener('click', showAddNewAuthor, false);

function hideAddNewAuthor()
{
    const addNewMenu = document.getElementById("add-new-author");
    addNewMenu.style.display = "none";
}
addNewMenuClose.addEventListener('click', hideAddNewAuthor, false);

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
                postnavsub.style.animation = "show-element 1s 1";
            }
    }

var postnav = document.getElementById("post-nav");
postnav.addEventListener('click', postSubMenu, false);

function showHandwriting()
{
    var handwritingContainer = document.getElementById("post-nav-handwriting");
    handwritingContainer.style.display = "block";
}

var handwritingNav = document.getElementById("post-nav-sub-option-handwriting");
handwritingNav.addEventListener('click', showHandwriting, false);

function hideHandwriting()
{
    var handwritingContainer = document.getElementById("post-nav-handwriting");
    handwritingContainer.style.display = "none";
}

var handwritingClose = document.getElementById("post-nav-handwriting-close");
handwritingClose.addEventListener('click', hideHandwriting, false);