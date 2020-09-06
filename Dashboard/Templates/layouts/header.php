<header class="header">
	<div class="row">
		<div class="col-6">
			<img src="/Dashboard/Resources/imgs/logo.png" class="logo">
		</div>
		<div class="col-6">
			<input type="text" class="inp search" placeholder="Search">
			<button class="search-cancel"></button>
			<h3 class="total">Total: <?= count($projects) ?></h3>
			<button class="button settings-open">Settings</button>
		</div>
	</div>
	<div class="row">
		<div class="col-8">
			<strong>Status:</strong>
			<span class="status-control" data-status="any">
				<a href="#" class="button small-button" data-status="open">Open</a>
				<a href="#" class="button small-button" data-status="closed">Closed</a>
				<a href="#" class="button small-button" data-status="any" style="display: none">Any</a>
			</span>
		</div>
		<div class="col-4">
			<div class="hidden-list-container float-right">
				<button class="button open-hidden-list float-right">Hidden list</button>
				<ul class="hidden-list">
					<h3>Hidden projects</h3>
					<div class="hidden-list-wrap">
						<li class="hidden-project">
							<span class="project-name">dashboard</span>
							<button class="button make-project-visible" data-project-name="dashboard" data-change-visibility>Make visible</button>
						</li>
					</div>
					<div class="loader-spin">Loading...</div>
				</ul>
			</div>
		</div>
	</div>
</header>

<div class="hidden-list-bg"></div>