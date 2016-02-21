function removeFieldCategory(container){
	var length = jQuery("#"+container).parent('div').children('div').length;
	if(length > 1){
		jQuery("div#"+container).remove();
	}
}