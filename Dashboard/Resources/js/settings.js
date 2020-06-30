class Settings{
	constructor(){
		const self = this;
		$('.settings-open').on('click', function(){
			$('.page.settings').addClass('open');
		});

		$('.settings-close').on('click', function(){
			$('.page.settings').removeClass('open');
		});

		$('.setting-item select').on('change', function(){
			let data = {
				setting_name: $(this).attr('name'),
				value: $(this).val()
			};
			self.save(data);
		});
	}

	save(data){
		const self = this;
		const urlForSaving = "/save-setting";
		$.ajax({
			url: urlForSaving,
			data: data,
			method: 'post'
		}).done(function(){
			const methName = 'doSetting_' + data['setting_name'].replace('-', '_');
			console.log(methName);
			self[methName](data['value']);
		});
	}

	doSetting_bg_texture(val){
		const styleTag = $('#style-bg-texture');
		const tpl = styleTag.attr('data-template');
		styleTag.html(tpl.replace('{{bg-texture}}', val));
	}

	doSetting_color_schema(val){
		const linkTag = $('#link-color-schema');
		const tpl = linkTag.attr('data-template');
		linkTag.attr('href', tpl.replace("{{color-schema}}", val));
	}
}