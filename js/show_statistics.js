$(document).ready(function(){
// SHOW STATISTICS
  $("#statistics-text-show").click(function(){
      $("#statistics-text-hide").show();
      $("#statistics-text-show").hide();
      $("#statistics-div").show();
  });
// HIDE STATISTICS
  $("#statistics-text-hide").click(function(){
      $("#statistics-text-show").show();
      $("#statistics-text-hide").hide();
      $("#statistics-div").hide();
  });
});