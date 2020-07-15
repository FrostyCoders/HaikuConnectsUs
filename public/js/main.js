// Empty and cold...

function showHandwriting()
{
    var handContainer = document.getElementById("post-nav-handwriting");
    if(handContainer.style.display==="block")
        {
            handContainer.style.display = "none";
        }
    else
        {
            handContainer.style.display = "block";
            handContainer.style.animation = "show-element 1s 1";
        }
}

var handOption = document.getElementById("post-nav-sub-option-handwriting");
handOption.addEventListener('click', showHandwriting, false);