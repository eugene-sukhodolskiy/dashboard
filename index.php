<?

include "app.php";
$projects = scan_hosts();
$projects = sort_by_date($projects);
// dd($projects);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="/favicon.png">

	<script type="text/javascript" src="/libs/jquery.js"></script>
	<script type="text/javascript" src="app.js"></script>
</head>
<body>
	<div class="grid">
		<header class="header">
			<div class="row">
				<div class="col-6">
					<h1 class="page-title">Total: <?= count($projects) ?></h1>
				</div>
				<div class="col-6">
					<form method="post" action="/form.php" class="create-new-project">
						<input type="text" name="create" class="inp create-project" placeholder="Create new project">
					</form>
				</div>
			</div>
		</header>

		<div class="row">
			<?php foreach($projects as $project): ?>
				<div class="col-12 col-md-6 col-lg-4 col-xl-3">
					<div class="project">
						<h3 class="project-title">
							<?= $project['project'] ? $project['project']['name'] : $project['name'] ?>
						</h3>
						<div class="description">
							<datetime class="last-update">
								Updated: <?= date("d.m.Y H:i", $project['last_update']); ?>
							</datetime>
							<?php if($project['project']): ?>
								<p class="ver">
									Version: <?= $project['project']['ver'] ?>
								</p>
								<p class="author">
									Author: <?= $project['project']['author'] ?>
								</p>
								<p class="release">
									Release: 
									<span class="incomplete release-link">
										<a href="<?= $project['project']['release_url'] ?>" target="_blank">
											<?= $project['project']['release_url'] ?>
										</a>
									</span>
								</p>
								<p class="git">
									Git: 
									<span class="incomplete git-link">
										<a href="<?= $project['project']['git_url'] ?>" target="_blank">
											<?= $project['project']['git_url'] ?>
										</a>
									</span>
								</p>
							<?php endif ?>
						</div>
						<div class="project-control">
							<a class="button" href="http://<?= $project['name'] ?>" target="_blank">Open</a>
							<!-- <a class="button" href="http://<?= $project['name'] ?>" target="_blank">Favotire</a> -->
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</body>
</html>