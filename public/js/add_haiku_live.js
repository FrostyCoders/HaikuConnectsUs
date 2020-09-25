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
            postCountry.style.visibility = "hidden";
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
            postCountry.style.visibility = "visible";
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
document.querySelector("#background-haiku").onchange = function()
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
        backgroundName.textContent = "Filename: "+filename;
        backgroundName.style.display = "block";
    }
    
    const buttonBgDelete = document.getElementById("file-delete-background");
    buttonBgDelete.style.display = "block";
}

document.querySelector("#handwriting-haiku").onchange = function()
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
        handwritingName.textContent = "Filename: "+filename;
        handwritingName.style.display = "block";
    }
    
    const buttonHwDelete = document.getElementById("file-delete-handwriting");
    buttonHwDelete.style.display = "block";
}

// ADD NEW AUTHOR
document.getElementById("add-author").addEventListener('click', () => {
    const addNewMenu = document.getElementById("add-new-author");
    addNewMenu.style.display = "block";
    addNewMenu.style.animation = "show-element 0.5s 1";
}, false);

document.getElementById("add-new-author-close").addEventListener('click', () => {
    document.getElementById("add-new-author").style.display = "none";
}, false);

// DROPDOWN MENU IN UP RIGHT CORNER OF POST
document.getElementById("post-nav").addEventListener('click', () => {
    const postnavsub = document.getElementById("post-nav-sub");

    if(postnavsub.style.display === "block")
    {
        postnavsub.style.display = "none";
    }
    else
    {
        postnavsub.style.display = "block";
        postnavsub.style.animation = "show-element 1s 1";
    }
}, false);

// SHOW HAIKU HANDWRITING CONTAINER
document.getElementById("post-nav-sub-option-handwriting").addEventListener('click', () => {
    const handwritingContainer = document.getElementById("post-nav-handwriting");
    handwritingContainer.style.display = "block";
}, false);

// HIDE HAIKU HANDWRITING CONTAINER
document.getElementById("post-nav-handwriting-close").addEventListener('click', () => {
    const handwritingContainer = document.getElementById("post-nav-handwriting");
    handwritingContainer.style.display = "none";
}, false);

function deleteBackground()
{
    const fileComplete = document.getElementById("file-complete");
    
    document.getElementById("file-delete-background").style.display = "none";
    document.getElementById('background-name').style.display = "none";
    document.getElementById("post-header").style.backgroundImage = "none";
    fileComplete.textContent = "Upload background";
    fileComplete.style.borderColor = "var(--dark-color)";
    fileComplete.style.color = "var(--dark-color)";
}

function deleteHandwriting()
{
    const fileCompleteHand = document.getElementById("file-complete-hand");
    
    document.getElementById("file-delete-handwriting").style.display = "none";
    document.getElementById('handwriting-name').style.display = "none";
    document.getElementById("post-nav-handwriting").style.backgroundImage = "none";
    fileCompleteHand.textContent = "Upload handwriting";
    fileCompleteHand.style.borderColor = "var(--dark-color)";
    fileCompleteHand.style.color = "var(--dark-color)";
}
