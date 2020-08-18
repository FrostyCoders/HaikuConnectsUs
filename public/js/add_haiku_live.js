// CHANGE AUTHOR ON LIVE
function liveAuthorHaiku()
{    
    var authorName = document.getElementById("author").value;
    var postAuthor = document.getElementById("post-author");
    var postCountry = document.getElementById("post-country");
    
    if(authorName.length < 1)
        {
            postAuthor.textContent = ".";
            postAuthor.style.visibility = "hidden";
        }
    else
        {
            var n = authorName.search(",");
            var authorCountry = "";
            if(n<0)
                {
                    authorCountry = "";
                }
            else
                {
                    authorCountry = authorName.substr(n+2, authorName.length);
                    var toDelete = authorName.substr(n, authorName.length);
                    authorName = authorName.replace(toDelete, "");
                }
            
            postAuthor.textContent = authorName;
            postAuthor.style.visibility = "visible";
            postCountry.textContent = authorCountry;
        }
    
    liveCheckEnter();
}

document.addEventListener('keyup', liveAuthorHaiku, false);

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
    
    let fullPath = document.getElementById('background-haiku').value;
    let backgroundName = document.getElementById('background-name');
    if (fullPath) 
    {
        let startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        let filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) 
        {
            filename = filename.substring(1);
        }
        backgroundName.textContent = "Nazwa pliku: "+filename;
        backgroundName.style.display = "block";
    }
    
    const buttonBgDelete = document.getElementById("file-delete-background");
    buttonBgDelete.style.display = "block";
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
    
    let fullPath = document.getElementById('handwriting-haiku').value;
    let handwritingName = document.getElementById('handwriting-name');
    if (fullPath) 
    {
        let startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        let filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) 
        {
            filename = filename.substring(1);
        }
        handwritingName.textContent = "Nazwa pliku: "+filename;
        handwritingName.style.display = "block";
    }
    
    const buttonHwDelete = document.getElementById("file-delete-handwriting");
    buttonHwDelete.style.display = "block";
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

function deleteBackground()
{
    const buttonBgDelete = document.getElementById("file-delete-background");
    const fileComplete = document.getElementById("file-complete");
    const postHeader = document.getElementById("post-header");
    const backgroundName = document.getElementById('background-name');
    
    buttonBgDelete.style.display = "none";
    backgroundName.style.display = "none";
    postHeader.style.backgroundImage = "none";
    fileComplete.textContent = "Upload background";
    fileComplete.style.borderColor = "var(--dark-color)";
    fileComplete.style.color = "var(--dark-color)";
}

const buttonBgDelete = document.getElementById("file-delete-background");
buttonBgDelete.addEventListener('click', deleteBackground, false);

function deleteHandwriting()
{
    const buttonHwDelete = document.getElementById("file-delete-handwriting");
    const fileCompleteHand = document.getElementById("file-complete-hand");
    const postHeaderHand = document.getElementById("post-nav-handwriting");
    const handwritingName = document.getElementById('handwriting-name');
    
    buttonHwDelete.style.display = "none";
    handwritingName.style.display = "none";
    postHeaderHand.style.backgroundImage = "none";
    fileCompleteHand.textContent = "Upload handwriting";
    fileCompleteHand.style.borderColor = "var(--dark-color)";
    fileCompleteHand.style.color = "var(--dark-color)";
}

const buttonHwDelete = document.getElementById("file-delete-handwriting");
buttonHwDelete.addEventListener('click', deleteHandwriting, false);