	(function(){
		// listen for scroll
		var positionElementInPage = $('#menuflotant').offset().top;
		$(window).scroll(
			function() {
				if ($(window).scrollTop() >= positionElementInPage) {
					// fixed
					$('#menuflotant').addClass("floatable");
				} else {
					// relative
					$('#menuflotant').removeClass("floatable");
				}
			}
		);

						})