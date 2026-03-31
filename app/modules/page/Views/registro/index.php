<style type="text/css">
    .carrito {
        visibility: hidden;
    }

    .form-group {
        margin: auto;
    }

    /* 
    .titulo-verde1,
    .contact {
        color: #123C5B;
    }

 

    .titulo-contact {
        margin-top: 4rem;
    }

    .enviar {
        background: #e28430;
        border: 0;
        font-weight: 500;
        border-radius: 15px;
        max-width: 278px;
        width: 211px;
        transition: all 300ms;
        padding: 7px;
        color: #FFF;

    }

    .enviar::after {
        content: "";
        display: block;
        border-bottom: 4px solid #d4d4d4;
        position: absolute;
        bottom: -5px;
        left: 0;
        right: -4px;
        width: 95px;
        text-align: center;
        margin: 12px auto;
    }

    .enviar:hover {
        color: #FFF;

        background: #b06018;
        border: 0;
    } */
</style>

<div class="container contenedor-perfil pt-3">

    <span>
        <h3 class="informacion-contacto mb-2 text-center mt-3">Registro Invitado </h3>
    </span>

    <div class="row registro">

        <?php if (date("d") <= 10 or 1 == 1) { ?>
            <form class="formulario- my-4" action="/page/registro/insertar" enctype="multipart/form-data"
                data-toggle="validator" autocomplete="nope" method="post" style="width: 100%;">
			<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

                <div class="form-group d-none">
                    <label for="usuario">Escoja el tipo de usuario</label>
                    <select class="form-control" name="usuario" id="usuario" required onchange='cambiar_formulario();'>
                        <option value="" disabled selected>Seleccione...</option>
                        <option value="2">Socio</option>
                        <option value="3" selected>Invitado</option>
                        <option value="4">Expositor Socio</option>
                        <option value="5">Expositor Invitado</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div id="form1" class="col-12 d-none">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre" style="color:#7e7e7e;">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder=""
                                value="<?php echo $this->nombreCompleto; ?>">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="correo" style="color:#7e7e7e;">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo"
                                value="<?php echo $this->correo; ?>" readonly placeholder="">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono" style="color:#7e7e7e;">Teléfono</label>
                            <input type="number" min="0" class="form-control" id="telefono" name="telefono" required
                                placeholder="" value="<?php echo $this->telefono; ?>"
                                data-error="El número de telefono debe ser minimo de 7 dígitos"
                                data-remote="/core/user/validartelusuario">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6 d-none" id="numero-accion">
                            <label for="accion" id="accion-label">Número de acción</label>
                            <input type="number" min="0" class="form-control" id="accion" name="accion"
                                data-error="Número de acción no valido" value="<?php echo $this->accion; ?>" placeholder=""
                                data-remote="/core/user/validaraccion">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6" id="socio-nombre">
                            <label for="nombre_socio" id="nombre_socio-label">Nombre del socio que lo invito</label>
                            <input type="text" min="0" class="form-control" id="nombre_socio" name="nombre_socio" required
                                placeholder="">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="usuario_persona" style="color:#7e7e7e;">Cédula (usuario)</label>
                            <input type="text" class="form-control" autocomplete="off" id="usuario_persona"
                                name="usuario_persona" placeholder=""
                                data-error="El usuario ya existe por favor intente recuperar la contraseña"
                                data-remote="/core/user/validarusuario">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="contrasena_persona" style="color:#7e7e7e;">Contraseña</label>
                            <input type="password" class="form-control" id="contrasena_persona" name="contrasena_persona"
                                required placeholder="" data-error="La clave debe ser mayor a 4 caracteres"
                                data-remote="/core/user/validarclave2">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="contrasena_persona" style="color:#7e7e7e;" class="control-label">Repita la
                                Contraseña</label>
                            <input type="password" value="" name="contrasena_personar" id="contrasena_personar"
                                data-match="#contrasena_persona" min="8"
                                data-match-error="Las dos contrasenas no son iguales" class="form-control" required>
                            </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div id="form2" class="d-none">
                    <div class="texto-registro pt-3 pb-5">
                        <p> Para cada producto, por favor envíe nombre, descripción, precio y una fotografía al correo <a
                                href="mailto:nux@clubelnogal.com" target="_blank">nux@clubelnogal.com</a> teniendo en cuenta
                            las siguientes características:</p>
                        <ol>
                            <li> <span> La foto deberá ser de buena resolución (nitidez y buena iluminación). Le sugerimos
                                    tomarla en un lugar que tenga luz natural. </span></li>
                            <li> <span>Preferiblemente usar fondos de color blanco o que tengan un muy buen contraste para
                                    que su producto se vea claramente. </span></li>
                            <li> <span>Por favor enviar las fotografías en cualquiera de los siguientes formatos .jpg .tiff
                                    . png. </span></li>

                        </ol>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="negocio">Nombre del negocio</label>
                            <input type="text" class="form-control" name="negocio" required id="negocio" placeholder="">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tiendas_imagen">Logo de la empresa</label>
                            <input type="file" name="tiendas_imagen" id="tiendas_imagen" class="form-control  file-image"
                                data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="pagina_web">Página web</label>
                            <input type="text" class="form-control" name="pagina_web" required id="pagina_web"
                                placeholder="www.misitio.com">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" name="facebook" required id="facebook"
                                placeholder="@usuario">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" name="instagram" required id="instagram"
                                placeholder="@usuario">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="telefono_negocio">Teléfono</label>
                            <input type="number" min="0" class="form-control" name="telefono_negocio" required
                                id="telefono_negocio" placeholder=""
                                data-error="El número de telefono debe ser minimo de 7 dígitos"
                                data-remote="/core/user/validartelnegocio">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="whatsapp">Whatsapp</label>
                            <input type="number" min="0" class="form-control" name="whatsapp" required id="whatsapp"
                                placeholder="" data-error="El numero de whatsapp debe ser de 10 dígitos"
                                data-remote="/core/user/validarwhatsappnegocio">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="correo_negocio">Correo</label>
                            <input type="email" class="form-control" name="correo_negocio" required id="correo_negocio"
                                placeholder="example@hotmail.com">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción del negocio</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="categoria">Escoja la categoría del negocio</label>
                            <select class="form-control" name="categoria" id="categoria" required>
                                <option disabled selected>Seleccione...</option>
                                <?php foreach ($this->categorias as $key => $categoria) { ?>
                                    <option value="<?php echo $categoria->categorias_id ?>">
                                        <?php echo $categoria->categorias_nombre ?>
                                    </option>
                                <?php } ?>

                            </select>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="accion_negocio">Número de acción</label>
                            <input type="number" min="0" class="form-control" name="accion_negocio" required
                                id="accion_negocio" placeholder="" data-error="Número de acción no valido"
                                data-remote="/core/user/validaraccionnegocio">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label for="usuario_negocio">Cédula (usuario)</label>
                            <input type="number" min="0" class="form-control" name="usuario_negocio" required
                                id="usuario_negocio" placeholder=""
                                data-error="El usuario ya existe por favor intente recuperar la contraseña"
                                data-remote="/core/user/validarnegocio">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contrasena_negocio">Contraseña</label>
                            <input type="password" max="4" class="form-control" name="contrasena_negocio" required
                                id="contrasena_negocio" placeholder="" data-remote="/core/user/validarclave3">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contrasena_negocio" class="control-label">Repita la Contraseña</label>
                            <input type="password" value="" max="4" name="contrasena_negocior" id="contrasena_negocior"
                                data-match="#contrasena_negocio" min="8"
                                data-match-error="Las dos contrasenas no son iguales" class="form-control" required>
                            </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center my-3">
                    <input type="checkbox" name="terminos" required>
                    <a class="terminos" href="https://www.clubelnogal.com/terminos-y-condiciones-de-uso/" target="_blank"
                        style="text-decoration: underline; color:#0073a8;"> Acepto las politicas de tratamiento de datos</a>
                </div>
                <div class="text-center col-12"><button class="enviar" type="submit">Registrarme</button></div>

            </form>
        <?php } else { ?>
            <div class="col-12 text-center">Estimado usuario, los registros estan permitidos unicamente los primeros 10 días
                de cada mes</div>
        <?php } ?>
    </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                No se ha podido enviar la solicitud de registro intentelo de nuevo
            </div>

        </div>
    </div>
</div>

<label class="form-check-label" for="gridCheck">
    <div class="modal fade" id="ventana">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #e28430;">
                    <h4 class="modal-title" align="center">
                        <?php echo $this->terminos->contenido_titulo; ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <?php echo $this->terminos->contenido_descripcion; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</label>
<script>
    <?php if ($this->error == "true") { ?>
        $('#myModal2').modal('show');
    <?php } ?>
</script>
<script>
    function cambiar_formulario() {
        var usuario = $("#usuario").val();
        if (usuario == 2 || usuario == 3) {
            if (usuario == 3) {
                //$("#socio-nombre").removeClass("d-none");
                //$("#numero-accion").addClass("d-none");
                //$("#socio-nombre").children("input").prop('required', true);
                //$("#numero-accion").children("input").prop('required', false);


                $("#socio-nombre").addClass("d-none");
                //$("#numero-accion").removeClass("d-none");
                $("#socio-nombre").children("input").prop('required', false);
                $("#numero-accion").children("input").prop('required', true);



            } else if (usuario == 2) {
                $("#socio-nombre").addClass("d-none");
                $("#numero-accion").removeClass("d-none");
                $("#numero-accion").children("input").prop('required', true);
                $("#socio-nombre").children("input").prop('required', false);

            }
            $('#form2').addClass("d-none");
            $('#form1').removeClass("d-none");
            $("#form2 .form-group").children("input").prop('required', false);
            $("#form1 .form-group").children("input").prop('required', true);
            $("#form2 .form-group").children("input").val("");
            $("#form2 .form-group").children("select").val("");
            $("#form2 .form-group").children("textarea").val("");
        } else if (usuario == 4 || usuario == 5) {
            $('#form2').removeClass("d-none");
            $('#form1').addClass("d-none");
            $("#form1 .form-group").children("input").prop('required', false);
            $("#form2 .form-group").children("input").prop('required', true);
            $("#form1 .form-group").children("input").val("");
            $("#form2 .form-group").children("select").val("");
            $("#form2 .form-group").children("textarea").val("");
            $("#whatsapp").prop('required', false);
            $("#instagram").prop('required', false);
            $("#facebook").prop('required', false);
            $("#pagina_web").prop('required', false);
        }
    }


    function f1() {
        cambiar_formulario();
    }
    setTimeout('f1()', 1000);
    setTimeout('f1()', 3000);
    setTimeout('f1()', 5000);
</script>