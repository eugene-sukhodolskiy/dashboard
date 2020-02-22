<? $this -> extends_from('base') ?>

<div class="row">
	<?php foreach($projects as $project): ?>
		<div class="col-12 col-md-6 col-lg-4 col-xl-3">
			<?= $this -> join('project.card', compact('project')); ?>
		</div>
	<?php endforeach; ?>
</div>