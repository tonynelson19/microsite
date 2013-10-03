$(function() {

	var carousels = $('.carousel');

	carousels.hammer().on('swipeleft', function() {
		$(this).carousel('next');
	});

	carousels.hammer().on('swiperight', function(){
		$(this).carousel('prev');
	});

});