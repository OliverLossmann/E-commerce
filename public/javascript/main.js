$(document).ready(function(){
  $('.header').height($(window).height());
})

(function(){
 
  $("#cart").on("click", function() {
    $(".shopping-cart").fadeToggle( "fast");
  });
  
})();