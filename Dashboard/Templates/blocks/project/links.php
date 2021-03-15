<div class="line links-container">
	<span class="heading">
		<span class="mdi mdi-link"></span>
		Links:
	</span>
	<table class="links">
		<tbody>
			<?php foreach ($links as $name => $link): ?>
				<? if(!strlen($link)) continue; ?>
				<tr>
					<th>
						<?= ucfirst(str_replace(['-', '_', '+'], ' ', trim($name))) ?>
					</th>
					<td>
						<a href="<?= $link ?>" target="_blank"><?= $link ?></a>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>