// Empty and cold...

function showHandwriting()
{
    var handContainer = document.getElementById("post-nav-handwriting");
    handContainer.style.display = "block";
    handContainer.style.animation = "show-element 1s 1";
}

var handOption = document.getElementById("post-nav-sub-option-handwriting");
handOption.addEventListener('click', showHandwriting, false);

function hideHandwriting()
{
    var handContainer = document.getElementById("post-nav-handwriting");
    handContainer.style.display = "none";
}

var handOptionClose = document.getElementById("post-nav-handwriting-close");
handOptionClose.addEventListener('click', hideHandwriting, false);