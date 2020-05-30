<div class="project" 
	data-title="<?= isset($project['project']['name']) ? $project['project']['name'] : $project['name'] ?>"
	data-tags='<?= (isset($project["project"]["tags"]) and is_array($project["project"]["tags"])) ? json_encode($project["project"]["tags"]) : json_encode([])  ?>'
	data-status="<?= isset($project['project']['status']) ? strtolower($project['project']['status']) : 'undefined' ?>"
>
	<h3 class="project-title">
		<? if(isset($project['project']['favicon']) and strlen($project['project']['favicon'])): ?>
			<img src="<?= $project['project']['favicon'] ?>" class="favicon">
		<? endif ?>
		<?= isset($project['project']['name']) ? $project['project']['name'] : $project['name'] ?>
	</h3>
	<div class="project-card-info">
		<? if(isset($project['project']['status'])): ?>
			<span class="status s-<?= strtolower($project['project']['status']) ?>"><?= $project['project']['status'] ?></span>
		<? endif ?>
		<? if(isset($project['project']['tags'])): ?>
			<? foreach($project['project']['tags'] as $i => $tag): ?>
				<? if($i == 5) break; ?>
				<a href="#" class="tag"><?= $tag ?></a>
			<? endforeach ?>
		<? endif ?>
	</div>

	<!-- DESCRIPTION FOR POPUP -->
	<div class="description">
		<h3 class="project-title">
			<? if(isset($project['project']['favicon']) and strlen($project['project']['favicon'])): ?>
				<img src="<?= $project['project']['favicon'] ?>" class="favicon">
			<? endif ?>
			<?= isset($project['project']['name']) ? $project['project']['name'] : $project['name'] ?>
		</h3>
		<datetime class="last-update">
			Updated: <?= date("d.m.Y H:i", $project['last_update']); ?>
		</datetime>

		<?php if($project['project']): ?>
			<? if(isset($project['project']['ver'])): ?>
				<p class="ver">
					Version: <?= $project['project']['ver'] ?>
				</p>
			<? endif ?>

			<? if(isset($project['project']['author'])): ?>
				<p class="author">
					Author: <?= $project['project']['author'] ?>
				</p>
			<? endif ?>

			<? if(isset($project['project']['release_url'])): ?>
				<p class="release">
					Release: 
					<span class="incomplete release-link">
						<a href="<?= $project['project']['release_url'] ?>" target="_blank">
							<?= $project['project']['release_url'] ?>
						</a>
					</span>
				</p>
			<? endif; ?>
			
			<? if(isset($project['project']['git_url'])): ?>
				<p class="git">
					Git: 
					<span class="incomplete git-link">
						<a href="<?= $project['project']['git_url'] ?>" target="_blank">
							<?= $project['project']['git_url'] ?>
						</a>
					</span>
				</p>
			<? endif ?>
		<?php endif ?>
		<div class="project-card-info">
			<? if(isset($project['project']['status'])): ?>
				<span class="status s-<?= strtolower($project['project']['status']) ?>"><?= $project['project']['status'] ?></span>
			<? endif ?>
			<? if(isset($project['project']['tags'])): ?>
				<? foreach($project['project']['tags'] as $tag): ?>
					<a href="#" class="tag"><?= $tag ?></a>
				<? endforeach ?>
			<? endif ?>
		</div>
		<div class="project-control">
			<a class="button open-project" href="http://<?= $project['name'] ?>" target="_blank">Open</a>
		</div>
	</div>
	<!-- END DESCRIPTION -->

	<div class="project-control">
		<a class="button open-project" href="http://<?= $project['name'] ?>" target="_blank">Open</a>
	</div>
</div>