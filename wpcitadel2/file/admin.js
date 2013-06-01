jQuery(document).ready(function(){
	jQuery('#cdlmenu #current-time').click(function(){
		var time = new Date();
		jQuery('#cdlmenu #yy').val( time.getFullYear() );
		jQuery('#cdlmenu #mm').val( time.getMonth() + 1 );
		jQuery('#cdlmenu #dd').val( time.getDate() );
		jQuery('#cdlmenu #hr').val( time.getHours() );
		jQuery('#cdlmenu #mi').val( time.getMinutes() );
		jQuery('#cdlmenu #ss').val( time.getSeconds() );
		return false;
	});
});