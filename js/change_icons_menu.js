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