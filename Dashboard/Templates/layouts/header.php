<header class="header">
	<div class="row">
		<div class="col-8">
			<div class="row">
				<div class="col-5">
					<img src="/Dashboard/Resources/imgs/logo.png" class="logo">
				</div>
				<div class="col-7">
					<input type="text" class="inp search" placeholder="Search">
					<button class="search-cancel"></button>
				</div>
			</div>
		</div>
		<div class="col-4">

			<div class="row">
				<div class="col-12 aside-popups-container">
					<?= $this -> join("layouts/settings.popup.php", [
						'settings' => $settings,
						'settings_variants' => $settings_variants
					]) ?>
					<?= $this -> join('layouts/hidden.list'); ?>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-8">
			<div style="margin-top: 20px;">
				<strong>Status:</strong>
				<span class="status-control" data-status="any">
					<a href="#" class="button small-button" data-status="open">Open</a>
					<a href="#" class="button small-button" data-status="closed">Closed</a>
					<a href="#" class="button small-button" data-status="any" style="display: none">Any</a>
				</span>
			</div>
		</div>
		<div class="col-4">
			<h3 class="total float-right">Total: <?= count($projects) ?></h3>
		</div>
	</div>
</header>

<div class="popup-mini-bg hidden-list-bg"></div>
<div class="popup-mini-bg hidden-settings-bg"></div>