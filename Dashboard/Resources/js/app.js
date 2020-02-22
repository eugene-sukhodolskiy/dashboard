$(document).ready(function(){
	$('.create-new-project').on('submit', function(e){
		if(!$('.create-project').val().length){
			return e.preventDefault();
		}
	});

	$('.project').on('click', function(e){
		$(this).find('.description').addClass('show');
		$('.global-popup-bg').addClass('show');
	});

	$('.global-popup-bg').on('click', function(){
		$('.project .description.show').removeClass('show');
		$(this).removeClass('show');
	});
});