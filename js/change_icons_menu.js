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
  var navlinkiconcontainer = document.getElementById("nav-link-icon-container");
  var navlinkicon1 = document.getElementById("nav-link-icon1");
  var navlinkicon2 = document.getElementById("nav-link-icon2");
  navlinkiconcontainer.style.display = "block";
  navlinkiconcontainer.style.animation = "show-nav-link-icon-container 0.35s 1";
  navlinkicon1.style.animation = "show-element 1s 1";
  navlinkicon2.style.animation = "show-element 1s 1";
}

function hideNavIcons() {
  var navlinkiconcontainer = document.getElementById("nav-link-icon-container");
  navlinkiconcontainer.style.display = "none";
}

var navicons = document.getElementById("nav-icons");
navicons.addEventListener('mouseenter', showNavIcons, false);
navicons.addEventListener('mouseleave', hideNavIcons, false);

$("#nav-icons").click(function(){
  $("nav-link-icon-container").css({"display": "block"});
});