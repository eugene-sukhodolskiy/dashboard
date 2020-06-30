<script>
	const SETTINGS = JSON.parse('<?= json_encode($settings) ?>');
</script>

<div class="settings page">
	<div class="container">
		<button class="button settings-close">Close</button>
		<h1>Settings</h1>
		<hr>
		<div class="setting-item">
			<label for="color-schema">Color Schema</label>
			<select name="color-schema" id="color-schema" class="input">
				<?php foreach ($settings_variants['color-schema'] as $i => $val): ?>
					<option value="<?= $val ?>" <? if($val == $settings['color-schema']) echo "selected" ?>><?= $val ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="setting-item">
			<label for="bg-texture">Background texture</label>
			<select name="bg-texture" id="bg-texture" class="input">
				<?php foreach ($settings_variants['bg-texture'] as $i => $val): ?>
					<option value="<?= $val ?>" <? if($val == $settings['bg-texture']) echo "selected" ?>><?= $val ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
</div>