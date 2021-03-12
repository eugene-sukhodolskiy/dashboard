<div class="project" 
	data-name="<?= $project['name'] ?>"
	data-title="<?= isset($project['project']['name']) ? $project['project']['name'] : $project['name'] ?>"
	data-tags='<?= (isset($project["project"]["tags"]) and is_array($project["project"]["tags"])) ? json_encode($project["project"]["tags"]) : json_encode([])  ?>'
	data-status="<?= isset($project['project']['status']) ? strtolower($project['project']['status']) : 'undefined' ?>"
	data-color="<?= isset($project['project']['project_color']) ? $project['project']['project_color'] : 'undefined' ?>"
	data-type="<?= isset($project['project']['type']) ? $project['project']['type'] : 'undefined' ?>"
>
	<h3 class="project-title">
		<? if(isset($project['project']['favicon']) and strlen($project['project']['favicon'])): ?>
			<img src="<?= $project['project']['favicon'] ?>" class="favicon">
		<? endif ?>
		<? if(isset($project['project']['main_lang'])): ?>
			<img src="/Dashboard/Resources/imgs/langs/file_type_<?= $project['project']['main_lang'] ?>@3x.png" class="favicon" title="<?= $project['project']['main_lang'] ?>">
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
			<? if(isset($project['project']['main_lang'])): ?>
				<img src="/Dashboard/Resources/imgs/langs/file_type_<?= $project['project']['main_lang'] ?>@3x.png" class="favicon" title="<?= $project['project']['main_lang'] ?>">
			<? endif ?>
			<?= isset($project['project']['name']) ? $project['project']['name'] : $project['name'] ?>
		</h3>
		<datetime class="last-update">
			<strong>Updated:</strong> <?= date("d.m.Y H:i", $project['last_update']); ?>
		</datetime>

		<? if(isset($project['project']) and isset($project['project']['type'])): ?>
			<p class="path-info">
				<strong>Project type:</strong>
				<?= $project['project']['type'] ?>
			</p>
		<? endif ?>

		<p class="path-info">
			<strong>Path to folder:</strong>
			<?= $project['path'] ?>
		</p>

		<?php if($project['project']): ?>
			<? if(isset($project['project']['ver'])): ?>
				<p class="ver">
					<strong>Version:</strong> <?= $project['project']['ver'] ?>
				</p>
			<? endif ?>

			<? if(isset($project['project']['authors'])): ?>
				<p class="author">
					<strong>Authors:</strong> 
					<?php foreach ($project['project']['authors'] as $i => $author): ?>
						<br>
						<?php if (isset($author['url']) and $author['url']): ?>
							<a href="<?= $author['url'] ?>" class="author-link">
								<?= $author['name'] ?>
							</a>
						<? else: ?>
							<?= $author['name'] ?>
						<?php endif ?>
						
						<? if(isset($author['email']) and $author['email']): ?>
							&lt;<?= $author['email'] ?>&gt;
						<? endif ?>
					<?php endforeach ?>
				</p>
			<? endif ?>

			<? if(isset($project['project']['release_url']) and strlen($project['project']['release_url'])): ?>
				<p class="release">
					<strong>Release: </strong>
					<span class="incomplete release-link">
						<a href="<?= $project['project']['release_url'] ?>" target="_blank">
							<?= $project['project']['release_url'] ?>
						</a>
					</span>
				</p>
			<? endif; ?>
			
			<? if(isset($project['project']['repository']) and isset($project['project']['repository']['url'])): ?>
				<p class="git">
					<strong><?= ucfirst($project['project']['repository']['type']) ?>: </strong>
					<span class="incomplete git-link">
						<a href="<?= $project['project']['repository']['url'] ?>" target="_blank">
							<?= $project['project']['repository']['url'] ?>
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

		<? if(isset($project['project']) and isset($project['project']['description']) and strlen($project['project']['description'])): ?>
			<p class="project-description-info">
				<strong>Project description:</strong>
				<?= $project['project']['description'] ?>
			</p>
		<? endif ?>

		<p class="project-counters">
			Total files <strong><?= $project['project']['scan']['list']['filtered']['total']['files'] ?></strong> 
			in <strong><?= $project['project']['scan']['list']['filtered']['total']['folders']+1 ?></strong> folders.
			<br>
			Total size <?= $project['project']['scan']['fsize'] ?>
		</p>

		<div class="project-control">
			<? if(isset($project['project']['type']) and $project['project']['type'] == 'web'): ?>
				<a class="button open-project" href="http://<?= $project['name'] ?>" target="_blank">Open</a>
			<? endif ?>
			<button class="button" data-project-name="<?= $project['name'] ?>" data-change-visibility="false">Hidden</button>
		</div>
	</div>
	<!-- END DESCRIPTION -->

	<div class="project-control root">
		<? if(isset($project['project']['type']) and $project['project']['type'] == 'web'): ?>
			<a class="button open-project" href="http://<?= $project['name'] ?>" target="_blank">Open</a>
		<? endif ?>
		<span class="short-path-to-project-folder" title="<?= $project['path'] ?>">...<?= substr($project['path'], -20, 20) ?></span>
	</div>
</div>