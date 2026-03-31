<?php
if (count($this->banners) > 0) { ?>
    <?php print_r($this->_view->banners); ?>
    <div class="slider-principal">
        <div id="carouselprincipal<?php echo $this->seccionbanner; ?>" class="carousel slide">
            <!-- <ol class="carousel-indicators">
                <?php foreach ($this->banners as $key => $banner) { ?>
                <li data-target="#carouselprincipal<?php echo $this->seccionbanner; ?>" data-slide-to="<?php echo $key ?>" <?php if ($key == 0) { ?>class="active d-none"<?php } ?>></li>
                <?php } ?>
            </ol> -->
            <div class="carousel-inner">
                <?php foreach ($this->banners as $key => $banner) { ?>
                    <div class="carousel-item <?php if ($key == 0) { ?>active <?php } ?>">
                        <?php if ($this->id_youtube($banner->publicidad_video) != false) { ?>
                            <div class="fondo-video-youtube">
                                <div class="banner-video-youtube" id="videobanner<?php echo $banner->publicidad_id; ?> "
                                    data-video="<?php echo $this->id_youtube($banner->publicidad_video); ?>"></div>
                            </div>
                        <?php } else { ?>
                            <div class="fondo-imagen i">
                                <?php if ($banner->publicidad_enlace) { ?>
                                    <a class="" id='enlace<?php echo $key ?>'
                                        href="<?php echo $banner->publicidad_enlace; ?>" <?php
                                                                                            if ($banner->publicidad_tipo_enlace == 1) { ?> target="_blank" <?php } ?>>
                                    <?php } ?>
                                    <img src="/images/<?php echo $banner->publicidad_imagen; ?>" class="d-none d-md-block">


                                    <img src="/images/<?php echo $banner->publicidad_imagenresponsive; ?>"
                                        class="d-block d-md-none">
                                    <?php if ($banner->publicidad_enlace) { ?>

                                    </a>
                                <?php } ?>

                                <div class="contenido-banner d-none d-md-flex"
                                    style="background-color:<?php echo $banner->publicidad_color_fondo; ?>;">
                                    <?php echo $banner->publicidad_descripcion; ?>

                                </div>
                            </div>
                        <?php } ?>
                        <!-- <div class="carousel-caption d-flex h-100 <?php echo $banner->publicidad_posicion; ?>" >
                        <div class="container texto-banner" style=" padding-top:7rem; " onclick="document.getElementById('enlace<?php echo $key ?>').click();">

                        </div>


                    </div> -->
                    </div>
                <?php } ?>
            </div>
            <a class="carousel-control-prev" type="button"
                data-bs-target="#carouselprincipal<?php echo $this->seccionbanner; ?>" data-bs-slide="prev">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" data-bs-target="#carouselprincipal<?php echo $this->seccionbanner; ?>"
                type="button" data-bs-slide="next">
                <i class="fa-solid fa-arrow-right"></i>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
<?php } ?>

<?php foreach ($this->banners as $key => $banner) { ?>
    <?php if ($banner->publicidad_enlace) { ?>
        <a class="btn btn-lg btn-success d-none" id='enlace<?php echo $key ?>' href="<?php echo $banner->publicidad_enlace; ?>"
            <?php
            if ($banner->publicidad_tipo_enlace == 1) { ?> target="_blank" <?php } ?>>
            <?php if ($banner->publicidad_enlace_vermas) { ?>
                <?php echo $banner->publicidad_enlace_vermas; ?>
            <?php } else { ?>
                Ver Más
            <?php } ?>
        </a>
    <?php } ?>
<?php } ?>