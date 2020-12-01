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

function deleteBackground()
{
    const fileComplete = document.getElementById("file-complete");
    document.getElementById('background-name').style.display = "none";
    document.getElementById("post-header").style.backgroundImage = "url(img/other/background.jpg";
    fileComplete.textContent = "Upload background";
    fileComplete.style.borderColor = "#353330";
    fileComplete.style.color = "#353330";
}

document.getElementById("form-delete").addEventListener('click', deleteBackground, false);