// REPORT POSTA
function reportPost()
{
    var postreport = document.getElementById("post-report-menu");
    postreport.style.display = "block";
    postreport.style.animation = "show-element 0.5s 1";
}

var postreport = document.getElementById("post-nav-sub-option-report");
postreport.addEventListener('click', reportPost, false);

// ZAMKNIĘCIE REPORTA POSTA
function reportPostClose()
{
    var postreport = document.getElementById("post-report-menu");
    postreport.style.display = "none";
}

var postreportclose = document.getElementById("post-report-close");
postreportclose.addEventListener('click', reportPostClose, false);

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