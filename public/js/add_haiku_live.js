// CHANGE AUTHOR ON LIVE
function liveAuthorHaiku()
{    
    var authorFirstname = document.getElementById("author-firstname").value;
    var authorSurname = document.getElementById("author-surname").value;
    var postAuthor = document.getElementById("post-author");
    var country = document.getElementById("country").value;
    var postCountry = document.getElementById("post-country");
    postCountry.textContent = country;
    var author = authorFirstname + " " + authorSurname;
    
    if(author.length <= 1)
        {
            postAuthor.textContent = ".";
            postAuthor.style.visibility = "hidden";
        }
    else
        {
            postAuthor.textContent = author;
            postAuthor.style.visibility = "visible";
        }
    
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
    
    reader.readAsDataURL(fileInput.files[0]) 
}

liveAuthorHaiku();

document.querySelector("#background-haiku").onchange=pullfiles;