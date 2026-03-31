<style>
    .main-content {
        display: grid;
        place-items: center;
    }

    .acompanamientos {

        font-size: 13px;
        line-height: 13px;
        /* border: 1px solid #d4d4d4; */
        padding: 10px;
        /* height: 108px; */
        overflow-y: auto;
        /* margin-left: auto; */
        width: 100%;
    }

    .enlace-carrito {
        pointer-events: none;
    }
</style>

<?php
$cuotas = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
?>

<div class="container contendor-barra">
    <div class="col-12 d-md-none px-3 my-3">
        <a href="/page/index?categoria=1&page=1#a" class="enlace-volver">
            <i class="fa-solid fa-circle-chevron-left"></i>
            <span>Regresar</span>

        </a>
    </div>
    <!-- <div id="scroll-progress"></div>

    <div class="titulo-proyecto">
        <h2 class="titulo-principal contact">Carrito de compras</h2>
    </div> -->
    <div class="contenedor-iconos">
        <a href="/page/index?categoria=1&page=1#a" class="enlace-volver d-none d-md-flex my-1">
            <i class="fa-solid fa-circle-chevron-left"></i>
            <span>Regresar</span>

        </a>
        <div id="step1" class="step">
            <span class="step-icon"><i class="fa-solid fa-check icon-check"></i></span> Carrito de compras
            <div class="ver-carrito d-block d-md-none lateral absolute ml-auto" style="margin-left:auto"></div>

        </div>
        <div id="step2" class="step hidden">
            <span class="step-icon"><i id="icono-proceso" class="fa-solid fa-check"></i></span> Proceso de pago
            <div class="ver-carrito d-none d-md-block  lateral absolute ml-auto" style="margin-left:auto"></div>
        </div>
    </div>

    <div id="progress-bar-container">
        <div id="progress-bar"></div>



    </div>
</div>




<div class="contenidos-productos w-100">
    <div class="container p-0 caja-pedido">



        <?php if ($this->error == "1") { ?>

            <div class='alert alert-danger text-center'>En este momento no es posible realizar tu pedido.</div>

        <?php } ?>

        <div>
            <?php if (count($this->carrito) > 0) { ?>
                <?php $contador = count($this->carrito); ?>
                <input type="hidden" value="<?php echo $contador; ?>" id="cantidad-carrito">
                <div class="">
                    <form action="/page/compra/enviar" method="post" onsubmit="$('#capturarvalortotal').hide();">
                        <div class="content-container" data-step="1">
                            <h3 class="titulo-verde1">
                                <i class="fa-solid fa-basket-shopping"></i>
                                Su pedido
                            </h3>
                            <div class="row">
                                <div class="col-12 col-lg-6 ">
                                    <div class="contenedor-productos-resumen">

                                        <?php $valortotal2 = 0;
                                        $totalpedido = 0;
                                        $x = 0;
                                        $error = 0; ?>
                                        <?php foreach ($this->carrito as $key => $carrito) { ?>
                                            <?php
                                            // print_r($carrito);
                                            ?>

                                            <?php $x++; ?>
                                            <?php
                                            $producto = $carrito['detalle'];
                                            $valor = (int) $carrito['cantidad'] * (int) $producto->productos_precio;
                                            $valortotal2 = $valortotal + $valor;
                                            $totalpedido += $valor;
                                            $acompanamientos = "";
                                            $errorProducto = 0;
                                            for ($i = 1; $i <= $carrito['cantidad']; $i++) {
                                                if ($carrito['acomp1_' . $i] != "") {
                                                    $acompanamientos .= "<span class='cafe'>Acompañamientos item" . $i . "</span class='cafe'><br>";
                                                    $acompanamientos .= "- " . $carrito['acomp1_' . $i] . "<br>";
                                                    if ($carrito['acomp2_' . $i] != "") {
                                                        $acompanamientos .= "- " . $carrito['acomp2_' . $i] . "<br>";
                                                    }
                                                    if ($carrito['acomp3_' . $i] != "") {
                                                        $acompanamientos .= "- " . $carrito['acomp3_' . $i] . "<br>";
                                                    }
                                                }

                                                if ($carrito['termino_' . $i] != "") {
                                                    $acompanamientos .= "<span class='cafe'>Trmino item" . $i . "</span><br>";
                                                    $acompanamientos .= "- " . $carrito['termino_' . $i] . "<br>";
                                                }
                                            }



                                            ?>
                                            <?php
                                            $max = 20;
                                            if ($producto->productos_cantidad < $max) {
                                                $max = $producto->productos_cantidad;
                                            }
                                            if ($producto->productos_limite_pedido != "" and $producto->productos_limite_pedido < $max) {
                                                $max = $producto->productos_limite_pedido;
                                            }
                                            ?>
                                            <div id="itempedido<?php echo $producto->productos_id; ?>"
                                                class="item-pedido shadow-sm">
                                                <div class="detalle-pedido">
                                                    <div class="detalle-carrito">
                                                        <div class="caja-item">
                                                            <div class="row align-items-center w-100 mx-auto">
                                                                <div class="col-sm-12 col-lg-3 p-0 m-0" align="center">
                                                                    <!-- <h5 <?php if ($x > 1) {
                                                                                    echo 'class="solo_cel"';
                                                                                } ?> style=" margin-top:;">&nbsp;</h5> -->
                                                                    <div class="column">
                                                                        <div class="caja-img-resumen">
                                                                            <?php if ($producto->productos_imagen != "" and file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/" . $producto->productos_imagen) === true) { ?>
                                                                                <img src="/images/<?php echo ($producto->productos_imagen); ?>"
                                                                                    class="img-resumen-producto"
                                                                                    alt="<?php echo $producto->productos_nombre; ?>">
                                                                            <?php } else { ?>
                                                                                <img src="/corte/product.png"
                                                                                    class="img-resumen-producto"
                                                                                    alt="<?php echo $producto->productos_nombre; ?>">
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                                <div class="col-sm-12 col-lg-9 p-0 m-0 contenedor-detalles">
                                                                    <div class="row align-items-center w-100 mx-auto h-100 ">
                                                                        <div class="col-12 p-0 m-0">
                                                                            <div class="titulo-producto-carrito" align="center">
                                                                                <!-- <h5 <?php if ($x > 1) {
                                                                                                echo 'class="solo_cel"';
                                                                                            } ?> style=" margin-top:;">Producto</h5> -->
                                                                                <div class="column">

                                                                                    <span
                                                                                        class="valor-tienda-negocio valor-nombre">
                                                                                        <?php echo $producto->productos_nombre; ?>
                                                                                    </span>
                                                                                    <?php if ($acompanamientos != "") { ?>
                                                                                        <div align="left"
                                                                                            class="acompanamientos shadow-sm mb-3">
                                                                                            <?php echo $acompanamientos; ?>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>

                                                                            </div>
                                                                            <?php if ($max == 0) { ?>
                                                                                <?php $error = 1; ?>
                                                                                <?php $errorProducto = 1; ?>
                                                                                <div class="text-center alert alert-danger"
                                                                                    id="error2">
                                                                                    <small
                                                                                        class=" text-center">Producto
                                                                                        no
                                                                                        disponible</small>
                                                                                </div>
                                                                                <?php $error = 1; ?>
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($carrito['cantidad'] >= $max and $max > 0) { ?>
                                                                                <div class="text-center  alert alert-danger"
                                                                                    id="error3">
                                                                                    <small
                                                                                        class=" text-center">Solo
                                                                                        <?php echo $max; ?> unidad(es)
                                                                                        disponible(s)</small>
                                                                                </div>
                                                                                <?php
                                                                                // $error = 1;
                                                                                ?>
                                                                            <?php } ?>
                                                                            <input type="hidden"
                                                                                id="valorunitario<?php echo $producto->productos_id; ?>"
                                                                                value="<?php echo $producto->productos_precio; ?>">
                                                                        </div>
                                                                        <?php if ($errorProducto == 0) { ?>

                                                                            <div class="col-3 col-lg-4 p-0 m-0" align="center">
                                                                                <!-- <h5 <?php if ($x > 1) {
                                                                                                echo 'class="solo_cel"';
                                                                                            } ?>>Valor unitario</h5> -->
                                                                                <div class="column">

                                                                                    <div class="valor-tienda-negocio">
                                                                                        <strong> </strong> <span> $
                                                                                            <?php echo number_format($producto->productos_precio); ?></span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-4 col-lg-4 p-0 m-0">
                                                                                <!-- <h5 <?php if ($x > 1) {
                                                                                                echo 'class="solo_cel"';
                                                                                            } ?>>Unidad</h5> -->
                                                                                <div class="column">

                                                                                    <div class="input-group input-group-sm"
                                                                                        style="">
                                                                                        <div class="input-group-prepend">
                                                                                            <button onclick="ocultar_error();"
                                                                                                class="btn btn-outline-secondary btn-minus"
                                                                                                data-id="<?php echo $producto->productos_id; ?>"
                                                                                                type="button" id="button-addon2"><i
                                                                                                    class="fas fa-minus"></i></button>
                                                                                        </div>
                                                                                        <input type="text"
                                                                                            class="form-control number cantidad-input"
                                                                                            id="cantidad<?php echo $producto->productos_id; ?>"
                                                                                            placeholder=""
                                                                                            value="<?php echo $carrito['cantidad']; ?>"
                                                                                            min="0" max="<?php echo $max; ?>"
                                                                                            disabled>
                                                                                        <div class="input-group-append">
                                                                                            <button
                                                                                                class="btn btn-outline-secondary btn-plus"
                                                                                                data-id="<?php echo $producto->productos_id; ?>"
                                                                                                type="button" id="button-addon1"><i
                                                                                                    class="fas fa-plus"></i></button>
                                                                                        </div>



                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-4 col-lg-3 p-0 m-0" align="center">
                                                                                <!-- <h5 <?php if ($x > 1) {
                                                                                                echo 'class="solo_cel"';
                                                                                            } ?>>Valor total</h5> -->

                                                                                <div class="column">

                                                                                    <div class="valor-tienda-negocio">
                                                                                        <strong></strong> <span
                                                                                            id="valortotal<?php echo $producto->productos_id; ?>">
                                                                                            <span>$
                                                                                                <?php echo number_format((int) $carrito['cantidad'] * (int) $producto->productos_precio); ?></span></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>

                                                                        <div class="col-1 col-lg-1 text-right  p-0 m-0 ms-auto">
                                                                            <!-- <h5 <?php if ($x > 1) {
                                                                                            echo 'class="solo_cel"';
                                                                                        } ?> style=" margin-top:">&nbsp;</h5> -->
                                                                            <div class="column">

                                                                                <a class="btn-eliminar-carrito"
                                                                                    data-id="<?php echo $producto->productos_id; ?>"
                                                                                    onclick="recarga()"><i
                                                                                        class="fa-solid fa-trash eliminar"></i></a>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </div>
                                    <script type="text/javascript">
                                        function recarga() {
                                            setTimeout(function() {
                                                window.location = window.location;
                                            }, 1000);
                                        }
                                    </script>
                                    <div class="total-carrito">
                                        <div class="row align-items-center">
                                            <div class="col-12 text-right">
                                                <div class="row g-1 align-items-center">
                                                    <div class="col-6 col-md-10" align="right">
                                                        <h5 class="margen_subtotal">Subtotal: </h5>
                                                    </div>
                                                    <?php $valortottal = $carrito['cantidad'] * $producto->productos_precio; ?>
                                                    <div class="valor-total-carrito col-6 col-md-2" id="totalpagar"
                                                        align="right">
                                                        $<?php echo number_format($valortotal2); ?>
                                                    </div>
                                                    <input type="hidden" name="totalpedido" id="totalpedido"
                                                        value="<?php echo $totalpedido; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-12 col-lg-6">
                                    <?php if ($this->config_propinas->config_tipo != 0) { ?>
                                        <h3 class="titulo-verde2 mt-0"><i class="fa-solid fa-coins"></i> Propina</h3>
                                        <?php if ($this->config_propinas->config_tipo == 1) { ?>
                                            <label>Agrega un valor</label>
                                            <input type="number" name="propina" id="propina" value="" <?php if (!$this->config_propinas->config_opcional == "1") {
                                                                                                            echo 'required';
                                                                                                        } ?> <?php if ($this->config_propinas->config_valor_minimo >= 0) {
                                                                                                                    echo 'min="' . $this->config_propinas->config_valor_minimo . '"';
                                                                                                                } ?> <?php if ($this->config_propinas->config_valor_maximo >= 0) {
                                                                                                                            echo 'max="' . $this->config_propinas->config_valor_maximo . '"';
                                                                                                                        } ?> class="form-control" onchange="calcular_envio();" onkeyup="calcular_envio();">
                                        <?php } ?>

                                        <?php if ($this->config_propinas->config_tipo == 2) { ?>
                                            <label>Selecciona un valor</label>
                                            <select class="form-control" name="propina" id="propina" onchange="calcular_envio();">
                                                <?php foreach ($this->opciones_propinas as $value): ?>
                                                    <option value="<?php echo $value->opcion_valor; ?>">$
                                                        <?php echo number_format($value->opcion_valor); ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        <?php } ?>

                                        <?php if ($this->config_propinas->config_tipo == 3) { ?>
                                            <label><?= $this->config_propinas->config_porcentaje; ?>% del valor total</label>
                                            <input type="number" name="propina" id="propina" value="" class="form-control"
                                                placeholder="Por favor digite el valor de la propina" readonly>
                                        <?php } ?>


                                    <?php } else { ?>
                                        <input type="hidden" name="propina" id="propina" value="0">
                                    <?php } ?>

                                    <hr>
                                    <div class=" content-container p-0" data-step="2">
                                        <div class="caja_gris">
                                            <h3 class="titulo-verde2"><i class="fa-solid fa-user-tag"></i>Información del
                                                socio o invitado</h3>

                                            <div class="row p-2 w-100 g-1">
                                                <div class="col-6 col-lg-3 form-group">
                                                    <label for="">Tipo documento:</label>
                                                    <select name="pedido_tipodocumento" id="pedido_tipodocumento"
                                                        class="form-control form-control-sm" required>
                                                        <option value="CC" <?php if ($this->socio->socio_tipo_documento == "CC") {
                                                                                echo 'selected';
                                                                            } ?>>CC</option>
                                                        <option value="CE" <?php if ($this->socio->socio_tipo_documento == "CE") {
                                                                                echo 'selected';
                                                                            } ?>>CE</option>
                                                        <option value="PS" <?php if ($this->socio->socio_tipo_documento == "PS") {
                                                                                echo 'selected';
                                                                            } ?>>PASAPORTE</option>
                                                        <option value="NIT" <?php if ($this->socio->socio_tipo_documento == "NIT") {
                                                                                echo 'selected';
                                                                            } ?>>NIT</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-lg-3  form-group">
                                                    <label for="">No. Documento</label>
                                                    <input type="text" name="pedido_documento" value="<?php if ($this->socio->socio_cedula != "") {
                                                                                                            echo $this->socio->socio_cedula;
                                                                                                        } else {
                                                                                                            echo $_SESSION['kt_cedula'];
                                                                                                        } ?>" id="pedido_documento" class="form-control form-control-sm"
                                                        required readonly>
                                                </div>
                                                <div class="col-6 col-lg-3  form-group">
                                                    <label for="">Nombre</label>
                                                    <input type="text" name="pedido_nombre" id="pedido_nombre" value="<?php if ($this->socio->socio_nombre != "") {
                                                                                                                            echo $this->socio->socio_nombre;
                                                                                                                        } else {
                                                                                                                            echo $_SESSION['kt_nombre'];
                                                                                                                        } ?>" class="form-control form-control-sm" required readonly>
                                                </div>
                                                <div class="col-6 col-lg-3  form-group">
                                                    <label for="">Apellido</label>
                                                    <input type="text" name="pedido_apellido" id="pedido_apellido" value="<?php if ($this->socio->socio_apellido != "") {
                                                                                                                                echo $this->socio->socio_apellido;
                                                                                                                            } else {
                                                                                                                                echo $_SESSION['kt_apellido'];
                                                                                                                            } ?>" class="form-control form-control-sm" required readonly>
                                                </div>
                                                <div class="col-6 col-lg-6  form-group">
                                                    <label for="">Correo</label>
                                                    <input type="email" name="pedido_correo" id="pedido_correo" value="<?php if ($this->socio->socio_correo != "") {
                                                                                                                            echo $this->socio->socio_correo;
                                                                                                                        } else {
                                                                                                                            echo $_SESSION['kt_correo'];
                                                                                                                        } ?>" class="form-control form-control-sm" readonly>
                                                </div>
                                                <div class="col-6 col-lg-3  form-group d-none">
                                                    <label for="">Teléfono Contacto</label>
                                                    <input type="number" name="pedido_telefono" id="pedido_telefono" value="<?php if ($_SESSION['kt_telefono'] != "") {
                                                                                                                                echo $_SESSION['kt_telefono'];
                                                                                                                            } ?>" class="form-control form-control-sm">
                                                </div>

                                                <div class="col-6 col-lg-3  form-group">
                                                    <label for="">Celular contacto</label>
                                                    <input type="number" name="pedido_celular" id="pedido_celular" value="<?php if ($this->socio->socio_celular != "") {
                                                                                                                                echo $this->socio->socio_celular;
                                                                                                                            } else {
                                                                                                                                echo $_SESSION['kt_celular'];
                                                                                                                            } ?>" class="form-control form-control-sm" readonly>
                                                </div>
                                                <div class="col-6 col-lg-3 form-group">
                                                    <label for="">Envío</label>
                                                    <select name="pedido_forma_envio" id="pedido_forma_envio"
                                                        class="form-control form-control-sm" onchange="forma_envio();"
                                                        required>
                                                        <option value="1">Domicilio</option>
                                                        <option value="2">Recoger en el Club</option>
                                                    </select>
                                                </div>

                                                <div class="col-12" id="div_recoger" style="display: none;">
                                                    <br>
                                                    <div class="alert alert-warning">Si elige esta opción, nos comunicaremos
                                                        con
                                                        usted al número de teléfono registrado, con el fin de informarle la
                                                        hora
                                                        para recoger el pedido en el Club<br>(Cr. 5 No. 78-75). </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caja_gris">

                                            <div class="margen_info div_direccion">
                                                <h3 class="titulo-verde2"><i class="fa-solid fa-truck-arrow-right"></i>
                                                    Informaci&oacute;n de envío</h3>
                                            </div>

                                            <div class="direcciones row w-100 p-2 mx-auto g-1">
                                                <span class="direcciones-guardadas"><i
                                                        class="fa-solid fa-location-dot"></i>Sus
                                                    direcciones guardadas</span>
                                                <div class="content-direcciones p-0 mb-3">
                                                    <?php if (is_countable($this->direcciones) && count($this->direcciones) > 0): ?>
                                                        <?php foreach ($this->direcciones as $direccion) { ?>
                                                            <div class="address-item d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-light">

                                                                <p class="direccion mb-0 flex-grow-1"
                                                                    data-id="<?php echo $direccion->direccion_id; ?>"
                                                                    data-numero1="<?php echo $direccion->direccion_numero1; ?>"
                                                                    data-letra1="<?php echo $direccion->direccion_letra1; ?>"
                                                                    data-numero2="<?php echo $direccion->direccion_numero2; ?>"
                                                                    data-letra2="<?php echo $direccion->direccion_letra2; ?>"
                                                                    data-numero3="<?php echo $direccion->direccion_numero3; ?>"
                                                                    data-complemento="<?php echo $direccion->direccion_complemento; ?>"
                                                                    data-nomenclatura="<?php echo $direccion->direccion_nomenclatura; ?>"
                                                                    data-indicaciones="<?php echo $direccion->direccion_indicaciones; ?>">
                                                                    <i class="fa-solid fa-map-marker-alt me-2 text-primary"></i>
                                                                    <strong><?php echo $direccion->direccion_nomenclatura; ?> <?php echo $direccion->direccion_numero1; ?><?php echo $direccion->direccion_letra1 ? $direccion->direccion_letra1 : ''; ?> # <?php echo $direccion->direccion_numero2; ?><?php echo $direccion->direccion_letra2 ? $direccion->direccion_letra2 : ''; ?> - <?php echo $direccion->direccion_numero3; ?></strong><br>
                                                                    <?php if ($direccion->direccion_complemento): ?><small class="text-muted"><?php echo $direccion->direccion_complemento; ?></small><?php endif; ?>
                                                                </p>
                                                                <span class="eliminar-direccion btn btn-sm btn-outline-danger ms-2"
                                                                    data-id="<?php echo $direccion->direccion_id; ?>"><i
                                                                        class="fa-solid fa-trash"></i></span>
                                                            </div>
                                                        <?php } ?>

                                                    <?php else: ?>
                                                        <div class="alert alert-info w-100 m-0">

                                                            No tiene direcciones guardadas

                                                        </div>
                                                    <?php endif; ?>


                                                </div>

                                                <span class="direcciones-guardadas mb-2">
                                                    <i class="fa-solid fa-user"></i>
                                                    <?php echo $_SESSION['kt_nombre']; ?>
                                                </span>




                                                <div class="col-12  col-lg-2 form-group div_direccion">
                                                    <label for="">Nomenclatura</label>
                                                    <select name="pedido_nomenclatura" id="pedido_nomenclatura"
                                                        class="form-control form-control-sm" onchange="calcular_envio();"
                                                        required>
                                                        <option value="">Seleccione...</option>
                                                        <option value="Avenida Calle">Avenida Calle</option>
                                                        <option value="Avenida Carrera">Avenida Carrera</option>
                                                        <option value="Calle">Calle</option>
                                                        <option value="Carrera">Carrera</option>
                                                        <option value="Diagonal">Diagonal</option>
                                                        <option value="Transversal">Transversal</option>
                                                    </select>
                                                    <div class="ejemplo">Ej: Carrera</div>
                                                </div>


                                                <div class="col-6 col-lg-2">
                                                    <label for="">Dirección</label>
                                                    <input type="number" class="form-control form-control-sm" name="numero1"
                                                        id="numero1" placeholder="Número" onchange="calcular_envio();"
                                                        onkeyup="calcular_envio();" min="0" value="" required>
                                                    <div class="ejemplo">7</div>
                                                </div>
                                                <div class="col-6 col-lg-1">
                                                    <label for="letra1"></label>
                                                    <input type="text" class="form-control form-control-sm" name="letra1"
                                                        id="letra1" placeholder="Letra" value="">
                                                    <div class="ejemplo">A</div>
                                                </div>
                                                <div class="col-2 col-lg-1 col-lg-05 text-center">
                                                    <label for=""></label>
                                                    <div>#</div>

                                                </div>
                                                <div class="col-3 col-lg-2">
                                                    <label for="numero2"></label>
                                                    <input type="number" class="form-control form-control-sm" name="numero2"
                                                        id="numero2" onchange="calcular_envio();"
                                                        onkeyup="calcular_envio();" placeholder="Número" min="0" value=""
                                                        required>
                                                    <div class="ejemplo">78</div>
                                                </div>
                                                <div class="col-3 col-2 col-lg-2">
                                                    <label for="letra2"></label>
                                                    <input type="text" class="form-control form-control-sm" name="letra2"
                                                        id="letra2" placeholder="Letra" value="">
                                                    <div class="ejemplo">B</div>
                                                </div>
                                                <div class="col-3 col-lg-1 col-lg-05 text-center">
                                                    <label for="letra2"></label>
                                                    <div>
                                                        -
                                                    </div>
                                                </div>
                                                <div class="col-3 col-lg-2">
                                                    <label for="numero3"></label>

                                                    <input type="number" class="form-control form-control-sm" name="numero3"
                                                        id="numero3" min="0" placeholder="Número" value="" required>
                                                    <div class="ejemplo">96</div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <textarea name="complemento" id="complemento"
                                                        class="form-control form-control-sm" placeholder="Complemento"
                                                        onchange="calcular_envio();" onkeyup="calcular_envio();"></textarea>
                                                    <div class="ejemplo">Apartamento, casa, piso, interior, otros.
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <textarea name="indicaciones" id="indicaciones"
                                                        class="form-control form-control-sm" placeholder="Indicaciones"
                                                        onchange="calcular_envio();" onkeyup="calcular_envio();"></textarea>
                                                    <div class="ejemplo">Indicaciones adicionales para llegar al
                                                        domicilio
                                                    </div>
                                                </div>
                                                <div class="col-4 col-lg-2">


                                                    <label class="toggle-switch mx-lg-auto d-block ">
                                                        <input type="checkbox" name="guardardireccion">
                                                        <div class="toggle-switch-background">
                                                            <div class="toggle-switch-handle"></div>
                                                        </div>
                                                    </label>
                                                    <div class="ejemplo mt-2">¿Guardar datos?
                                                    </div>

                                                </div>



                                                <input type="hidden" name="pedido_estado" id="pedido_estado" value="2"
                                                    class="form-control form-control-sm">


                                                <span class="direcciones-guardadas mt-2">
                                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                                    Datos para facturación electrónica
                                                </span>
                                                <div class="col-lg-4 form-group ">
                                                    <label for="">Nombre</label>
                                                    <input type="text" name="pedido_nombrefe" id="pedido_nombrefe"
                                                        class="form-control form-control-sm" required>
                                                </div>
                                                <div class="col-12 col-lg-4 ">
                                                    <label for="">Correo</label>
                                                    <input type="email" name="pedido_correofe" id="pedido_correofe"
                                                        class="form-control form-control-sm" required>
                                                </div>
                                                <div class="col-12 col-lg-4">
                                                    <label for="">Celular</label>
                                                    <input type="text" name="pedido_celularfe" id="pedido_celularfe"
                                                        class="form-control form-control-sm" pattern="^3[0-9]{9}$"
                                                        maxlength="10" title="Ingrese un número de celular válido que inicie con 3 y tenga 10 dígitos"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 10)" required>
                                                </div>



                                            </div>


                                            <div class="col-sm-3 form-group d-none">
                                                <label for="pedido_ciudad" class="control-label">Ciudad</label>
                                                <select name="pedido_ciudad" id="pedido_ciudad"
                                                    class="form-control form-control-sm">
                                                    <option value="">Seleccione...</option>
                                                    <?php foreach ($this->ciudades as $key => $ciudad) { ?>
                                                        <option value="<?php echo utf8_encode($ciudad->nombre); ?>">
                                                            <?php echo utf8_encode($ciudad->nombre);
                                                            ($ciudad->departamento) ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="caja_gris">

                                            <div class="col-12 margen_info">
                                                <h3 class="titulo-verde2"><i class="fa-solid fa-money-bill"></i>Información
                                                    de pago</h3>
                                            </div>
                                            <div class="direcciones row w-100 p-2 mx-auto g-1">

                                                <div class="col-lg-6 form-group">
                                                    <label for="">Método de pago</label>
                                                    <select name="pedido_medio" id="pedido_medio"
                                                        class="form-control form-control-sm" onchange="metodo_pago();"
                                                        required>
                                                        <option value="">--Seleccione un método de pago--</option>
                                                        <?php if ($_SESSION['kt_login_level'] != 5) { ?>
                                                            <option value="1">Cargo a la acción</option>
                                                        <?php } ?>
                                                        <option value="2">Pago en lnea</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="mensaje-autorizacion margen_politica m-0 p-0">
                                                        <div class="form-check p-0 d-flex gap-2 align-items-center"
                                                            required>
                                                            <input class="form-check-input m-0" type="checkbox"
                                                                id="gridCheck" required> <label for="gridCheck"
                                                                class="terminos" data-bs-toggle="modal"
                                                                data-bs-target="#comoComprar" data-bs-toggle="modal"> Acepto
                                                                términos y condiciones</label>

                                                        </div>

                                                    </div>
                                                    <div class="mensaje-autorizacion margen_politica" id="div_terminos2"
                                                        style="display: none;">
                                                        <div class="form-check" required>
                                                            <input class="form-check-input" type="checkbox" id="gridCheck2"
                                                                required><a class="terminos" href="#ventana21"
                                                                data-toggle="modal">
                                                                Autorizo cargar a mi acción el valor total del servicio de
                                                                domicilio
                                                                (Nogal en casa) solicitado a través de esta plataforma.</a>
                                                            <label class="form-check-label" for="gridCheck2">
                                                                <div class="modal fade" id="ventana2">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" align="center">
                                                                                    <?php echo $this->terminos->contenido_titulo; ?>
                                                                                </h4>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>

                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p><?php echo $this->terminos->contenido_descripcion; ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </label>
                                                        </div>

                                                        <select name="pedido_cuotas" id="pedido_cuotas"
                                                            class="form-select w-100 w-md-5"
                                                            aria-label="Default select example">
                                                            <option selected disabled value="">Seleccione el número de
                                                                cuotas...
                                                            </option>
                                                            <?php foreach ($cuotas as $cuota) { ?>
                                                                <option value="<?= $cuota ?>"><?= $cuota ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="alert alert-light d-none">
                                                    <?php echo $this->terminos->contenido_descripcion; ?>
                                                </div>

                                                <label class="form-check-label" for="gridCheck">
                                                    <div class="modal fade modal-negro" id="ventana" tabindex="-1"
                                                        aria-labelledby="ventanaLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-fullscreen modal-terminos">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">

                                                                        <?php echo $this->terminos->contenido_descripcion; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </label>


                                            </div>
                                        </div>
                                    </div>


                                    <div class="row px-2 px-0 g-0 content-info-pago">
                                        <div class="col-8 text-end">
                                            <h3 class="titulo-envio">Costo productos:</h3>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span id="pedido_productoscosto" class="font-weight-bold">
                                                $<?php echo number_format($valortotal2); ?>COP</span>
                                        </div>

                                        <div class="col-8 text-end">
                                            <h3 class="titulo-envio">Costo de env&iacute;o: </h3>
                                        </div>
                                        <div class="col-4 text-end">
                                            <span id="pedido_enviocosto" class="font-weight-bold"></span>
                                        </div>


                                        <div class="col-8 text-end div_propina">
                                            <h3 class="titulo-envio">Propina:
                                            </h3>
                                        </div>
                                        <div class="col-4 text-end div_propina">
                                            <span id="pedido_propina1"></span>
                                        </div>
                                        <div class="col-8 text-end">
                                            <h3 class="titulo-total">Total: </h3>
                                        </div>

                                        <div class="col-4 text-end">
                                            <span id="pedido_valorpagar" class="font-weight-bold"></span>

                                        </div>



                                    </div>
                                </div>
                                <input type="hidden" id="pedido_valorpagar1" name="pedido_valorpagar1">

                                <div id="error1"></div>
                                <div class="alert alert-danger text-center d-none" role="alert">
                                    Recuerda que si pagas tu pedido despues de las - 12pm, el pedido no se
                                    podr
                                    procesar el da de hoy </div>
                                <div class="alert alert-warning text-center d-none" id="alertamonto" role="alert">
                                    El valor total de su pedido debe ser igual o superior a $30,000 COP.
                                </div>
                                <div class="col-12 d-flex flex-column flex-lg-row justify-content-between align-items-center gap-2 px-2 px-0"
                                    align="center" id="div-comprar">

                                    <div class="pagar-compra w-100" align="right"><a href="/page/index?categoria=1&page=1#a"
                                            class="btn btn-sm  btn-primary-carrito m-0 btn-primary-carrito-seguir pointer">Seguir
                                            comprando</a></div>

                                    <?php if (($_SESSION['kt_accion'] != "00012301" || 1 == 1) && $error == 0) { ?>
                                        <div class="vr"></div>
                                        <button type="submit" id="capturarvalortotal" class="btn-pagar  w-100">Ir a
                                            pagar</button>
                                    <?php } ?>
                                </div>
                            </div>


                            <input type="hidden" name="pedido_zona" id="pedido_zona" value="">
                            <input type="hidden" name="pedido_envio" id="pedido_envio" value="0">
                            <input type="hidden" name="pedido_propina" id="pedido_propina" value="0">
                        </div>
                    </form>
                </div>

            <?php } else { ?>

                <br>
                <br>
                <div class="mensaje-alert my-5  alert alert-info w-100" align="center">
                    <h5 class="p-0 m-0">No hay productos en tu carrito</h5>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<hr>



<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const progressBar = document.getElementById("progress-bar");
        const step1 = document.getElementById("step1");
        const step2 = document.getElementById("step2");
        const iconoProceso = document.getElementById("icono-proceso");


        const contentContainers = document.querySelectorAll(".content-container");
        window.addEventListener("scroll", function() {
            let maxScrollHeight = document.documentElement.scrollHeight - window.innerHeight;
            let currentScroll = window.scrollY;
            let progress = 50;
            progress = progress + (currentScroll / maxScrollHeight) * 100;
            progressBar.style.width = `${progress}%`;
            if (progress >= 55) {
                iconoProceso.classList.add("icon-check")
            } else {
                iconoProceso.classList.remove("icon-check")
            }
            contentContainers.forEach((container) => {
                const rect = container.getBoundingClientRect();
                if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
                    const step = container.getAttribute("data-step");
                    updateProgressBar(step);
                }
            });
        });

        function updateProgressBar(step) {
            if (step === "1") {
                step1.classList.remove("hidden");
                step2.classList.add("hidden");
            } else if (step === "2") {
                step1.classList.remove("hidden");
                step2.classList.remove("hidden");
            }
        }
    });

    function calcular_envio() {
        var nomenclatura = $("#pedido_nomenclatura").val();
        var numero1 = $("#numero1").val();
        var numero2 = $("#numero2").val();
        var complemento = $("#complemento").val();
        $.post("/page/compra/calcularenvio", {
            "nomenclatura": nomenclatura,
            "numero1": numero1,
            "numero2": numero2,
            "complemento": complemento
        }, function(res) {


            var total = 0;
            var cantidadtotal = 0;
            var envio = res.valor * 1;
            var forma = $("#pedido_forma_envio").val();
            if (forma == "2") {
                envio = 0;
            }
            $("#error1").html("");


            $(".btn-minus").each(function() {
                var id = $(this).attr("data-id");
                var cantidad = $("#cantidad" + id).val();
                var valorunitario = $("#valorunitario" + id).val();
                var valortotal = parseInt(valorunitario) * parseInt(cantidad);
                total = parseInt(total) + parseInt(valortotal);
                cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
                $
            });

            //propina
            var propina = $("#propina").val();
            propina = propina * 1;
            if (propina > 0) {
                $(".div_propina").show();
            } else {
                $(".div_propina").hide();
            }

            <?php if ($this->config_propinas->config_tipo == 3) { ?>
                var porcentaje = '<?= $this->config_propinas->config_porcentaje; ?>';
                propina = Number(total) * Number(porcentaje) / 100;
                propina = Math.round(propina);
                $("#propina").val(propina);
            <?php } ?>

            $("#pedido_propina").val(propina);
            $("#pedido_propina1").html("$ " + addCommas(parseInt(propina)) + " COP");
            //propina

            if (propina > 0) {
                var valorpagar = parseInt(envio) + total + parseInt(propina);
            } else {
                var valorpagar = parseInt(envio) + total;
            }


            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
            console.log(total);
            $("#pedido_valorpagar").html("$ " + addCommas(parseInt(valorpagar)) + " COP");
            $("#pedido_enviocosto").html("$ " + addCommas(parseInt(envio)) + " COP");
            $("#pedido_valorpagar1").val(parseInt(valorpagar));

            $("#capturarvalortotal").show();

            if (res.error != "0") {
                if (numero1 != "" && numero2 != "" && nomenclatura != "") {
                    $("#error1").html("<div class='alert alert-danger text-center'>Lo sentimos. El rango de cobertura para entrega a domicilio no incluye esta zona.</div>");
                    $("#capturarvalortotal").hide();
                }
            }

            $("#pedido_zona").val(res.zona_nombre);
            $("#pedido_envio").val(envio);

        });
    }

    function forma_envio() {
        var forma = $("#pedido_forma_envio").val();
        if (forma == "2") { //recoger en club
            $(".div_direccion").hide();
            $("#pedido_nomenclatura").prop("required", false);
            $("#numero1").prop("required", false);
            $("#numero2").prop("required", false);
            $("#numero3").prop("required", false);
            $("#numero1").val("");
            $("#numero2").val("");
            $("#numero3").val("");
            $("#div_recoger").show();
        } else {
            $(".div_direccion").show();
            $("#pedido_nomenclatura").prop("required", true);
            $("#numero1").prop("required", true);
            $("#numero2").prop("required", true);
            $("#numero3").prop("required", true);
            $("#div_recoger").hide();
        }
        calcular_envio();
    }

    function metodo_pago() {
        var metodo = $("#pedido_medio").val();
        if (metodo == "2" || metodo == "") {
            $("#div_terminos2").hide();
            $("#gridCheck2").prop("required", false);
            $("#pedido_cuotas").prop("required", false);

        } else {
            $("#div_terminos2").show();
            $("#gridCheck2").prop("required", true);
            $("#pedido_cuotas").prop("required", true);

        }
    }

    function ocultar_error() {
        $("#error2").hide();
        $("#error3").hide();
    }

    function f1() {
        calcular_envio();
    }
    setTimeout(f1, 1000);
    setTimeout(f1, 2000);
</script>
<style>
    .contenidos-productos .btn-pagar:disabled {
        background: #ccc !important;
        border: none !important;
        cursor: not-allowed !important;
    }
</style>