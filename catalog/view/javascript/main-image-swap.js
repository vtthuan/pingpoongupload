//-----------------------------------------
// Author: Qphoria@gmail.com
// Web: http://www.OpenCartGuru.com/
//-----------------------------------------
$(document).ready(function(){

	// Get main image info
	var img = $('#mainImage img')
	var imgUrl = img.attr('src'); // get img popup href
	if (imgUrl != undefined) {
		var imgWidth = imgUrl.substring(imgUrl.lastIndexOf('-') + 1, imgUrl.lastIndexOf('x'));
		var imgHeight = imgUrl.substring(imgUrl.lastIndexOf('x') + 1, imgUrl.lastIndexOf('.'));
	}

    $('.image-additional img').hover(function() {
		var newsrc = $(this).parent().attr('href');
		
		$('#mainImage img').fadeOut(200,function() {
			$('#mainImage img').attr({
				src: newsrc,
				title: $(this).attr('title'),
				alt: $(this).attr('alt'),
				width: imgWidth,
				height: imgHeight
			}).fadeIn(200);
		});
		
	    
	},
	function()
	{
		$('#mainImage img').fadeOut(200,function() {
			$('#mainImage img').attr({
				src: imgUrl,
				title: img.attr('title'),
				alt: img.attr('alt'),
				width: imgWidth,
				height: imgHeight
			}).fadeIn(200);
		});
		
		
	});
});