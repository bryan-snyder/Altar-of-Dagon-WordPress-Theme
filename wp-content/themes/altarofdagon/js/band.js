// Preloader
jQuery(window).load(function() {
 jQuery("#altarOfLoading").delay(1300).fadeOut('slow');
});

//Parallax
jQuery(document).ready(function(){
   $window = jQuery(window);
   jQuery('section[data-type="background"]').each(function(){
     var $scroll = jQuery(this);
      jQuery(window).scroll(function() {
        var yPos = -($window.scrollTop() / $scroll.data('speed'));
        var coords = '50% '+ yPos + 'px';
        $scroll.css({ backgroundPosition: coords });
      });
   });
});
document.createElement("section");
