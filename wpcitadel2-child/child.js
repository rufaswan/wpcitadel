jQuery(document).ready(function(){

	// -----------------nav---------------------------------------
	jQuery("nav li").click(function(){
		//console.log("clicked");
		//jQuery("nav li ul").hide();
		jQuery("ul", this).toggle();
	});
	// -----------------nav---------------------------------------

	// -----------------slideshow---------------------------------
	var interv = setInterval(runSlides, 5000);
	// no depth
	var numSlides = jQuery('#slideshow li').length - jQuery('#slideshow li li').length;
	var slideCount = 1;
	var firstSlide = jQuery('#slideshow li:first');
	firstSlide.addClass('current');

	function runSlides(){
		var currSlide = jQuery('#slideshow li.current');

		currSlide.fadeOut('fast', function(){
			currSlide.removeClass('current');

			//console.log(slideCount);
			//console.log(numSlides);

			if ( slideCount < numSlides ) {
				currSlide.next().fadeIn('fast', function(){
					currSlide.next().addClass('current');
				});
				slideCount += 1;
			} else {
				firstSlide.fadeIn('fast', function(){
					firstSlide.addClass('current');
				});
				slideCount = 1;
			}
		});
	}
	// -----------------slideshow---------------------------------

});