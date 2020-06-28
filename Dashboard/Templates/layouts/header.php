<header class="header">
	<div class="row">
		<div class="col-6">
			<img src="/Dashboard/Resources/imgs/logo.png" class="logo">
		</div>
		<div class="col-6">
			<input type="text" class="inp search" placeholder="Search">
			<button class="search-cancel"></button>
			<h3 class="total">Total: <?= count($projects) ?></h3>
			<button class="button">Settings</button>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<strong>Status:</strong>
			<span class="status-control" data-status="any">
				<a href="#" class="button small-button" data-status="open">Open</a>
				<a href="#" class="button small-button" data-status="closed">Closed</a>
				<a href="#" class="button small-button" data-status="any" style="display: none">Any</a>
			</span>
		</div>
	</div>
</header>