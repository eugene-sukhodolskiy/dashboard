<header class="header">
	<div class="row">
		<div class="col-6">
			<img src="/Dashboard/Resources/imgs/logo.png" class="logo">
		</div>
		<div class="col-6">
			<!-- <form method="post" action="/form.php" class="create-new-project">
				<input type="text" name="create" class="inp create-project" placeholder="Create new project">
			</form> -->
			<h3 class="total">Total: <?= count($projects) ?></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<strong>Status:</strong>
			<? if(isset($filters['status']) and $filters['status'] == 'open'): ?>
				<a href="/status/closed" class="button small-button">Closed</a>
				<a href="/" class="button small-button">Any</a>
			<? elseif(isset($filters['status']) and $filters['status'] == 'closed'): ?>
				<a href="/status/open" class="button small-button">Open</a>
				<a href="/" class="button small-button">Any</a>
			<? else: ?>
				<a href="/status/open" class="button small-button">Open</a>
				<a href="/status/closed" class="button small-button">Closed</a>
			<? endif ?>
		</div>
	</div>
</header>