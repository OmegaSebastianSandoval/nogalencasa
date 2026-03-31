<div class="container">
    <div class="row">
        <?php foreach ($this->contenidos as $key => $contenido) { ?>
            <div class="col-sm-4">
            <a href="/page/contenidos/detalle/<?php echo $contenido->contenido_id ?>/<?php echo $this->urllimpia($contenido->contenido_titulo); ?>" class="btn btn-block "><?php echo $contenido->contenido_titulo ?></a>
            </div>
        <?php } ?>
    </div>
    
</div>