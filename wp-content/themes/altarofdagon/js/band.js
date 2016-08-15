//Use Dollar Signs ;-)
jQuery(document).ready(function($) {
// Preloader
$(window).load(function() {
 $("#altarOfLoading").delay(1300).fadeOut('slow');
});

//Parallax
$(document).ready(function(){
   $window = $(window);
   $('section[data-type="background"]').each(function(){
     var $scroll = $(this);
      $(window).scroll(function() {
        var yPos = -($window.scrollTop() / $scroll.data('speed'));
        var coords = '50% '+ yPos + 'px';
        $scroll.css({ backgroundPosition: coords });
      });
   });
});
document.createElement("section");


}); //End use dollar signs
