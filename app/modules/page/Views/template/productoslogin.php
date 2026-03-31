<div class="parent d-none d-md-grid">
	<?php if ($infotcontent[0]->contenido_imagen) { ?>
		<div class="child-1">
			<img src="/images/<?php echo $infotcontent[0]->contenido_imagen ?>" class="img-grid" alt="">
			<span class="grid-precio">
				<?php echo $infotcontent[0]->contenido_descripcion ?>
			</span>
		</div>
	<?php } ?>
	<?php if ($infotcontent[1]->contenido_imagen) { ?>

		<div class="child-2">
			<img src="/images/<?php echo $infotcontent[1]->contenido_imagen ?>" class="img-grid" alt="">
			<span class="grid-precio">
				<?php echo $infotcontent[1]->contenido_descripcion ?>
			</span>

		</div>
	<?php } ?>
	<?php if ($infotcontent[2]->contenido_imagen) { ?>

		<div class="child-3">
			<img src="/images/<?php echo $infotcontent[2]->contenido_imagen ?>" class="img-grid" alt="">
			<span class="grid-precio">
				<?php echo $infotcontent[2]->contenido_descripcion ?>
			</span>

		</div>
	<?php } ?>

	<?php if ($infotcontent[3]->contenido_imagen) { ?>

		<div class="child-4">
			<img src="/images/<?php echo $infotcontent[3]->contenido_imagen ?>" class="img-grid" alt="">
			<span class="grid-precio">
				<?php echo $infotcontent[3]->contenido_descripcion ?>
			</span>

		</div>
	<?php } ?>

</div>


