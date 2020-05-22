jQuery(document).ready(function($) {
    
  var allPanels = jQuery('.wikis > dd').hide();
    
  jQuery('.wikis > dt > a').click(function() {
    allPanels.slideUp();
    jQuery(this).parent().next().slideDown();
    return false;
  });

});