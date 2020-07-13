function liveAddHaiku()
{    
    var author = document.getElementById("author").value;
    var inEnglish = document.getElementById("in-english").value;
    var inNative = document.getElementById("in-native").value;
    var isChecked = document.getElementById("ischecked").checked;
    var background;

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
    
    setTimeout(liveLoop, 1000);
}

function liveLoop()
{
    setTimeout(liveAddHaiku, 1000);
}

liveLoop();