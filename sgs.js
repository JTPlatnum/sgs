$(document).ready(function(){
	/*Click handler for tabs*/
	$('#tab_container').on('click', '.tab', function(){
		$('.tab').removeClass('active');
		$(this).addClass('active');	
			if ($('#tab1').hasClass('active')) {
				$('.content').removeClass('active');
				$('#content1').addClass('active');
			} else if ($('#tab2').hasClass('active')){
				$('.content').removeClass('active');
				$('#content2').addClass('active');
			} else if ($('#tab3').hasClass('active')){
				$('.content').removeClass('active');
				$('#content3').addClass('active');
			} else if ($('#tab4').hasClass('active')){
				$('.content').removeClass('active');
				$('#content4').addClass('active');
			} else {
				$('.content').removeClass('active');
				$('#content5').addClass('active');
			}
	});

	$('#content_container').on('click', '#getstarted', function(){
		$('.tab').removeClass('active');
		$('.content').removeClass('active');
		$('#tab3').addClass('active');
		$('#content3').addClass('active')
	});

	$('#content_container').on('click', '#getgraded', function(){
		$('.tab').removeClass('active');
		$('.content').removeClass('active');
		$('#tab4').addClass('active');
		$('#content4').addClass('active')
	});

	$('#content_container').on('click', '#additionalinfo', function(){
		$('.tab').removeClass('active');
		$('.content').removeClass('active');
		$('#tab5').addClass('active');
		$('#content5').addClass('active')
	});

/*	
	var slideshowImages = [
		{
			url: 'https://thismoment-a.akamaihd.net/other/1354120897-1641.jpeg',
			link: 'https://www.google.com'
		}, 
		{	
			url: 'https://thismoment-a.akamaihd.net/other/1354120918-1641.jpeg',
			link: 'https://www.thismoment.com'
		},
		{
			url: 'https://thismoment-a.akamaihd.net/other/1354120930-1641.jpeg',
			link: 'https://www.espn.com'	
		}
	], 
		currentImageIndex = 0,
		intervalId;

	function setActiveImage (index) {

		var newImageURL = slideshowImages[currentImageIndex].url,
			newImageLink = slideshowImages[currentImageIndex].link

   		$('#image_container').fadeOut(200, function () {
      		$('#image_container').css('background-image', 'url(' + newImageURL + ')');
       		$('#image_container').fadeIn(200);
   		 });
		$('#image_container').attr('href', '"' + newImageLink + '"');

	}

	function play() {

		var $playButton = $(this);

		if( $playButton.hasClass('pause')){
			$playButton.removeClass('pause');
			clearInterval( intervalID );
		} else {
			$playButton.addClass('pause');
			nextImage();
			intervalID = window.setInterval(function() {nextImage();}, 4000);
		}
	}

	function prevImage() {	
		if (currentImageIndex === 0) {
			currentImageIndex = (slideshowImages.length - 1);
		} else {
			currentImageIndex = ( currentImageIndex - 1 );
		}
		setActiveImage();		
	}	 

	function nextImage() {	
		if (currentImageIndex === slideshowImages.length - 1 ){
			currentImageIndex = 0;
		} else {
			currentImageIndex = ( currentImageIndex + 1 );
		}
		setActiveImage();
	}


	$('#slideshow')
		.on('click', '#prev_arrow', prevImage)
		.on('click', '#play_button', play)
		.on('click', '#next_arrow', nextImage);
			
	intervalID = window.setInterval(function() {nextImage();}, 4000);
*/
});		