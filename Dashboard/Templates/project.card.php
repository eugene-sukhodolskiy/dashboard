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