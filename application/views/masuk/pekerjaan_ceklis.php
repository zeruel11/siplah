<div class="card">
	<div class="card-block">
		<ul class="list-group list-group-flush">
			<?php foreach ($dataPekerjaan as $row) { ?>
				<li class="list-group-item">
					echo $dataPekerjaan[$k]['detailPekerjaan'];
				</li>
			<?php } ?>
		</ul>
	</div>
</div>