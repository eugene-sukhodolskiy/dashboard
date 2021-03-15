<? extract($this -> parent() -> get_inside_data()); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="/Dashboard/Resources/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Dashboard/Resources/libs/materialdesign-icons/css/materialdesignicons.min.css">
	<link rel="stylesheet" type="text/css" href="/Dashboard/Resources/css/style.css">
	<link rel="stylesheet" id="link-color-schema" data-template="/Dashboard/Resources/css/color-schema/{{color-schema}}.css" href="/Dashboard/Resources/css/color-schema/<?= $settings['color-schema'] ?>.css">
	<style id="style-bg-texture" data-template=":root{--bg-texture: url('../imgs/bg-texture/{{bg-texture}}.png');}">
		:root{--bg-texture: url('../imgs/bg-texture/<?= $settings['bg-texture'] ?>.png');}
	</style>
	<link rel="icon" href="/favicon.png">

	<script type="text/javascript" src="/Dashboard/Resources/libs/jquery.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/color.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/search.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/settings.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/project-control.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/hotkey.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/keynav.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/app.js"></script>
</head>
<body class="custom-scroll">
	<div class="global-popup-bg"></div>

	<div class="grid">
		<?= $this -> join('layouts/header.php', $this -> parent() -> get_inside_data()); ?>
		<?= $this -> content() ?>
	</div>

</body>
</html>