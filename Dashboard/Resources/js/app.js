$(document).ready(function(){
	$('.create-new-project').on('submit', function(e){
		if(!$('.create-project').val().length){
			return e.preventDefault();
		}
	});

	$('.project').on('click', function(e){
		let btnOpenProject = $(this).find('.open-project');
		if(btnOpenProject.hasClass('no-info')){
			btnOpenProject.removeClass('no-info');
		}else{
			$(this).find('.description').addClass('show');
			$('.global-popup-bg').addClass('show');
		}
	});

	$('.global-popup-bg').on('click', function(){
		$('.project .description.show').removeClass('show');
		$(this).removeClass('show');
	});

	$('.open-project').on('click', function(){
		$(this).addClass('no-info');
	});

	$('.project').each(function(){
		const propForProjectColor = SETTINGS['project-color-in'];
		let fav = $(this).find('.favicon', 0);
		let project = $(this);
		if(project.attr('data-color') != 'undefined'){
			project.css(propForProjectColor, project.attr('data-color'));
		}else{
			if(fav.length){
				new Color(fav, function(c){
					let rgba = 'rgba(' + c[0] + ', ' + c[1] + ', ' + c[2] + ', 1)';
					project.css(propForProjectColor, rgba);
				});
			}
		}
	});

	searchInit();
});

function searchInit(){
	searchObject = new Search('input.search', '.project', '.status-control');
	$('.project-card-info .tag').on('click', function(e){
		e.preventDefault();
		let projectCard = $(this).parent().parent();
		if($(projectCard).hasClass('project')){
			$(projectCard).find('.open-project').addClass('no-info');
		}else{
			projectCard.parent().find('.open-project').addClass('no-info');
			$('.global-popup-bg').trigger('click');
		}
		let searchString = $(this).html().trim().toLowerCase();
		$('input.search').val(searchString);
		$('.search-cancel').addClass('visible');
		searchObject.search(searchString, 'tags');
	});

	$('input.search').on('input', function(){
		if($('input.search').val().length){
			$('.search-cancel').addClass('visible');
		}else{
			$('.search-cancel').removeClass('visible');
		}
	});

	$('.search-cancel').on('click', function(){
		$('input.search').val('').trigger('input');
	});

	$('.status-control a').on('click', function(e){
		e.preventDefault();
		let status = $(this).attr('data-status');
		$(this).parent().find('a').show();
		$(this).hide();
		$(this).parent().attr('data-status', status);
		searchObject.search($('input.search').val());
	});

	settings = new Settings();
}

let settings;
let searchObject;