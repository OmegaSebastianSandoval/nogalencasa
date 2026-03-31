<div class="domicilios">
<div class="banner"><?php echo $this->bannersimple; ?></div>
<div class="container pestanas-cont">
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
                            <div>
                                <a href="/page/productos/?categoria=<?php echo $categoria->categorias_id; ?>"><?php echo $categoria->categorias_nombre; ?></a>
                            </div>
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
<div class="container">
    <?php foreach($this->domicilios as $key => $domicilio) { ?>
        <div class="row">
            <div class="col-sm-6"><h2 class="titulo-domicilio"><?php echo $domicilio->contenido_titulo;?></h2></div>
            <div class="col-sm-6 vendido" style="/*padding-top:3rem;*/">
                <a href="/page/productos/destacados" class="btn-lomasvendido">Lo más vendido >></a>
            </div>
        </div>
        <div class="text-center"><img src="/images/<?php echo $domicilio->contenido_imagen;?> " alt=""></div>
        <div class="descripcion"><?php echo $domicilio->contenido_descripcion;?></div>
    <?php } ?>
    </div>
</div>