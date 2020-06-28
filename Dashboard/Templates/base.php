<? extract($this -> parent() -> get_inside_data()); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="/Dashboard/Resources/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Dashboard/Resources/css/style.css">
	<link rel="icon" href="/favicon.png">

	<script type="text/javascript" src="/Dashboard/Resources/libs/jquery.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/color.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/search.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/settings.js"></script>
	<script type="text/javascript" src="/Dashboard/Resources/js/app.js"></script>
</head>
<body>

	<div class="global-popup-bg"></div>

	<div class="grid">
		<?= $this -> join('layouts/header.php', $this -> parent() -> get_inside_data()); ?>
		<?= $this -> content() ?>
	</div>

</body>
</html>