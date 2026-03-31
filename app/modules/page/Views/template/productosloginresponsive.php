<div class="parent-2 d-grid d-md-none">

	<?php foreach ($infotcontent as $content) {
		?>
		<div class="child">
			<img src="/images/<?php echo $content->contenido_imagen ?>" class="img-grid" alt="">
			<span class="descr">
				<?php echo $content->contenido_descripcion ?>
			</span>
		</div>
	<?php } ?>


</div>
