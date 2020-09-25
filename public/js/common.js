const Loading = (state) => {
    const container = document.getElementsByClassName("points-loading-container")[0];
    if(state == true)
        container.style.display = "block";
    else
        container.style.display = "none";
}

const checkArray = (array, value) => {
    if(Array.isArray(array) == false)
        return false;
    
    let found = false;
    array.forEach(element => {
        if(element == value)
            found = true;
    });
    return found;
};

function showCommunicate(message) {
    if(message[1].length == 0)
        return ;
    const box = document.getElementById("page-communicate");
    const boxIcon = document.getElementById("page-communicate-icon");
    const boxText = document.getElementById("page-communicate-text");
    boxText.innerText = message[1];
    box.style.display = "flex";
    new Promise((resolve, reject) => {
        if(message[0] == false){
            box.style.color = "red";
            boxIcon.style.backgroundImage = "url(img/icons/no.svg)";
        }   
        else{
            box.style.color = "#353330";
            boxIcon.style.backgroundImage = "url(img/icons/yes.svg)";
        }   
        resolve();
    }).then(() => {
        if(message[0] == false)
        {
            box.animate([
                { transform: 'translateX(-45%)' },
                { transform: 'translateX(-55%)' },
                { transform: 'translateX(-50%)' }
            ], {
                duration: 100,
                iterations: 3
            });
        }
        else
        {
            box.animate([
                { top: "6rem" }, 
                { top: "6.5rem" }
            ], {
                duration: 300,
                iterations: 1
            });
        }
    }).then(() => {
        setTimeout(() => {
            box.style.display = "none";
        }, 5000);
    });
};

const menuPos = document.getElementsByClassName("nav-link");
Array.from(menuPos).forEach(element => {
    element.addEventListener("click", () => {
        if(sessionStorage.getItem("toEdit") !== null)
        {
            sessionStorage.removeItem("toEdit");
        }
    });
});

// TOOLTIP
$(document).ready(function(){
    $('.logo-tooltip').tooltip({html: true, animation: true, placement: "bottom"});
});

// CHANGE ICONS MENU
$(document).ready(function(){
    // SHOW MENU CLOSE ICON
      $("#navbar-toggler-menu").click(function(){
          setTimeout(function(){ $("#navbar-toggler-menu").css({"display": "none"}); }, 300);
          setTimeout(function(){ $("#navbar-toggler-menu-close").css({"display": "block"}); }, 300);
      });
    // SHOW MENU ICON
      $("#navbar-toggler-menu-close").click(function(){
          setTimeout(function(){ $("#navbar-toggler-menu-close").hide(); }, 300);
          setTimeout(function(){ $("#navbar-toggler-menu").css({"display": "block"}); }, 300);
      });
});
    
    // ANIMATION ON AVATAR ICON
    function showNavIcons() {
      const navlinkiconcontainer = document.getElementById("nav-link-icon-container");
      const navlinkicon1 = document.getElementById("nav-link-icon1");
      const navlinkicon2 = document.getElementById("nav-link-icon2");
      navlinkiconcontainer.style.display = "block";
      navlinkiconcontainer.style.animation = "show-nav-link-icon-container 0.35s 1";
      navlinkicon1.style.animation = "show-element 1s 1";
      navlinkicon2.style.animation = "show-element 1s 1";
    }
    
    function hideNavIcons() {
      const navlinkiconcontainer = document.getElementById("nav-link-icon-container");
      navlinkiconcontainer.style.display = "none";
    }
    
    const navicons = document.getElementById("nav-icons");
    navicons.addEventListener('mouseenter', showNavIcons, false);
    navicons.addEventListener('mouseleave', hideNavIcons, false);
    
    $("#nav-icons").click(function(){
      $("nav-link-icon-container").css({"display": "block"});
    });

// COOKIE ALERT
function cookieAlert(name,value,time){
    let cookieTime = "";
    if (time){
        let date = new Date();
        date.setTime(date.getTime() + (time*24*60*60*99999));
        cookieTime = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + cookieTime + "; path=/";
}

if (document.cookie.indexOf("cookie_alert=") < 0) {
    const cookieAlertBar = document.getElementById("cookie-alert-close");

    cookieAlertBar.addEventListener('click', function() {
    document.getElementById("cookie-alert").style.display = "none";
    cookieAlert('cookie_alert','1',1);
    });
}