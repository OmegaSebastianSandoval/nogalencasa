<div class="ubicacion">
<div class="banner"><?php echo $this->bannersimple; ?></div>
<div class="container">
    <div class="row pestanas">
        <div class="col-lg-6 align-self-center filtro">
            <div class="row">
                <div class="col-sm-6 filtrar">
                    <i class="fas fa-filter"></i> Filtrar por Categoría 
                </div>
                <div class="col-sm-6 text-right boton-filtro">
                    <div class="btn-group">
                        <button type="button" class="btn btn-productos dropdown-toggle" style="backgrund-color:#fe0c05;" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                            Todos los Productos
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                        <?php foreach ($this->categorias as $key => $categoria ) { ?>
                            <button class="dropdown-item" type="button"><?php echo $categoria->categorias_nombre; ?></button>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 text-center ciudad">
            Ciudad de Envío: Bogotá
        </div>
        <div class="col-lg-2 buscar">
            <div class="row">
                <div class="col-sm-6 buscar-text">
                    <span>Buscar</span>
                </div>
                <div class="col-sm-6 text-right buscar-ico">
                    <i class="fas fa-search" align="right"></i>
                </div>
            </div> 
        </div>
    </div>
<div>
    <?php echo $this->ubicacion; ?>
    
</div>