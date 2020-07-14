// CHANGE AUTHOR ON LIVE
function liveAuthorHaiku()
{    
    var author = document.getElementById("author").value;
    var postAuthor = document.getElementById("post-author");
    postAuthor.textContent = author;
    
    liveCheckEnter();
}

// CHANGE HAIKU POST ON LIVE
function liveCheckEnter()
{
    var inEnglish = document.getElementById("in-english").value;
    var inNative = document.getElementById("in-native").value;
    var postHaiku = document.getElementById("post-haiku");
    var isChecked = document.getElementById("ischecked").checked;
   
    var inEnglishArray = Array.from(inEnglish);
    var inNativeArray = Array.from(inNative);
    
    postHaiku.textContent = "";
    
    if(isChecked == false)
        {
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
var pullfiles = function()
{ 
    var fileInput = document.querySelector("#background-haiku");
    
    var reader = new FileReader();
    reader.onload = function()
    {
        var postHeader = document.getElementById("post-header"); 
        postHeader.style.backgroundImage = 'url('+reader.result+')';
    }
    
    reader.readAsDataURL(fileInput.files[0]) 
}

liveAuthorHaiku();

document.querySelector("#background-haiku").onchange=pullfiles;