<!--  +++++++++++++++++++++++++++++++++++++++++ INDEX DE CONTACTENOS +++++++++++++++++++++++++++++++++++++++   -->

<div class="banner">
    <?php //echo $this->bannersimple; 
    ?>
</div>
<!--<div class="container">
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
                        <?php foreach ($this->categorias as $key => $categoria) { ?>
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
<div>-->
<!-- <div class="titulo-internas2">
    <div class="container">
        <div class="row">
            <div class="col-12 titulo-contact">
                <h2 class="contact">Contacto</h2>
            </div>
        </div>
    </div>
</div>
<br> -->
<div class="contenidocontacto pt-4" data-aos="fade-up-right">
    <div class="container">
        <div class="row justify-content-center">
            <div class=" col-11  col-lg-6 order-2 order-lg-1 ">
                <h3 class="informacion-contacto"><i class="fa-solid fa-address-book"></i> Contácto</h3>


                <form action="/page/formulario/enviar" method="post" onsubmit="return miFuncion(this)"
                    class="form-contact shadow-sm ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mt-2">
                                <label>Nombre</label>
                                <input name="formulario_nombre" type="text" class="form-control"
                                    placeholder="Juan Pérez" required>
                            </div>
                            <div class="form-group mt-2">
                                <label>E-mail</label>
                                <input name="formulario_email" type="email" class="form-control"
                                    placeholder="juan@example.com" required>
                            </div>
                            <div class="form-group mt-2">
                                <label>Teléfono</label>
                                <input name="formulario_telefono" type="text" class="form-control"
                                    placeholder="3001234567" required>
                            </div>
                            <div class="form-group mt-2">
                                <label>Ciudad</label>
                                <input name="formulario_ciudad" type="text" class="form-control" placeholder="Bogotá"
                                    required>
                            </div>
                            <div class="form-group mt-2">
                                <label>Mensaje</label>
                                <textarea style="resize:none;" class="form-control" name="formulario_mensaje" id=""
                                    rows="3" placeholder="Escribe tu mensaje aquí" required=""></textarea>
                            </div>
                            <input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">
                        </div>
                    </div>
                    <div class="form-check margen_politica" required>
                        <input class="form-check-input" type="checkbox" id="gridCheck" required>
                        <label class="form-check-label" for="gridCheck">
                            <a class="terminos cafe" href="#" data-bs-toggle="modal"
                                data-bs-target="#tratamientoDatos">Política de tratamiento de datos</a>
                        </label>
                    </div>
                    <script src='https://www.google.com/recaptcha/api.js'></script>
                    <div class="g-recaptcha" data-sitekey="6LfFDZskAAAAAE2HmM7Z16hOOToYIWZC_31E61Sr"></div>
                    <script>
                        function miFuncion (a) {
                            var response = grecaptcha.getResponse();

                            if (response.length == 0) {
                                alert("Captcha no verificado");
                                return false;
                                event.preventDefault();
                            } else {
                                return true;
                            }
                        }
                    </script>
                    <div class=" col-md-11 text-center">
                        <button type="submit" class="btn btn-primary enviar" style="margin-top: 10px;">Enviar</button>
                    </div>
                    <br>
                </form>
            </div>
            <!-- <div class="col-lg-1 mt-4 mt-lg-0 ">
            </div> -->


            <div class="col-11 col-lg-6 order-1 order-lg-2 pt-3">
                <div class="cont-info mt-4">
                    <?php foreach ($this->informaciones as $key => $informacion) { ?>

                        <p class="informacion-contacto-info ">Información de contacto</p>
                        <div class="pro"><?php echo $informacion->info_pagina_informacion_contacto; ?></div>

                    <?php } ?>


                </div>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="ventana">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center"><?php echo $this->terminos->contenido_titulo; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->terminos->contenido_descripcion; ?> </p>
            </div>
        </div>
    </div>
</div>