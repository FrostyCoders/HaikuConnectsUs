function liveAddHaiku()
{    
    var author = document.getElementById("author").value;
    var inEnglish = document.getElementById("in-english").value;
    var inNative = document.getElementById("in-native").value;
    var isChecked = document.getElementById("ischecked").checked;

    var postAuthor = document.getElementById("post-author");
    postAuthor.textContent = author;
    
    var postHaiku = document.getElementById("post-haiku");
    if(isChecked == false)
        {
            postHaiku.textContent = inEnglish;
        }
    else if(isChecked == true)
        {
            postHaiku.textContent = inNative;
        }
    

    
    liveCheckEnter();
    setTimeout(liveAddHaiku, 1000);
}

function liveCheckEnter()
{
    var inEnglish = document.getElementById("in-english").value;
    var inEnglishs = document.getElementById("in-english");
    var inNative = document.getElementById("in-native").value;
    var postHaiku = document.getElementById("post-haiku");
    if (inEnglish.keyCode === 13)
        {
            inEnglish = inEnglish + "/n";
            postHaiku.textContent = inEnglish;
        }
} 

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

liveAddHaiku();

document.querySelector("#background-haiku").onchange=pullfiles;