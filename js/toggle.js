jQuery(document).ready(function () { 
	jQuery('.wikis dd').hide();
		jQuery('.wikis > dt').hover(function(){jQuery(this).addClass('hover')},function(){jQuery(this).removeClass('hover')}).click(function(){
		jQuery(this).next().slideToggle('normal');
		});	
	
});