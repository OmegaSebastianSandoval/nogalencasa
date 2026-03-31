<style type="text/css">
    #select_menu {
        text-align: center;
        text-align-last: center;
    }

    #select_menu option {
        text-align: left;
    }

    .enviar {
        background-color: #123C5B;
        border: 1px solid #123C5B;
    }

    .enviar:hover {
        background-color: #123C5B;
        border: 1px solid #123C5B;
    }
</style>

<div class="banner">
    <?php echo $this->bannerprincipal; ?>
</div>
<a id="a" name="a"></a>

<div class="fondo-new">

    <div class="container contenedordelivery py-3" id="contenedordelivery">

        <form class="d-none" method="post" action="/page/index/#a">
            <div class="input-group d-flex flex-nowrap position-relative">
                <input class="form-control buscar w-100 " name="buscar" value="<?php echo $_POST['buscar']; ?>"
                    type="search" placeholder="Buscar aquí" aria-label="Buscar" required>
                            <input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

                <button class="btn btn-outline-dark position-absolute search-home" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i><!-- Icono de lupa de Bootstrap Icons -->
                </button>
            </div>
        </form>
    </div>

</div>

<div class="container contenedordelivery-home p-0">
    <div class="row pb-5 g-0">
        <?php if ($this->cat) { ?>
            <div class="col-12  col-md-12 mx-auto ">

                <h4 class="titulo-icon"><i class="fa-solid fa-magnifying-glass"></i> Descubre lo más reciente</h4>
                <hr>


                <div class="col-12 col-md-12 mx-auto">
                <?php } else { ?>
                    <div class="col-12  ">


                        <div class="col-12">

                        <?php } ?>




                        <?php echo $this->productos ?>

                        </div>
                        <?php if ($this->cat) { ?>

                            <h4 class="mt-5 titulo-icon"><i class="fa-solid fa-shop"></i> Categorías de la tienda</h4>
                            <hr>
                            <div class="row col-12 col-lg-11 mx-auto">

                                <?php foreach ($this->categorias as $categoria) { ?>
                                    <div class="col-6 col-md-3 col-lg-2">
                                        <a href="?categoria=<?php echo $categoria->categorias_id; ?>&page=1#a"
                                            class="enlace-categoria">
                                            <div class="categoria-home">
                                                <?php if ($categoria->categorias_imagen and file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/" . $categoria->categorias_imagen)) { ?>

                                                    <img src="/images/<?php echo $categoria->categorias_imagen ?>"
                                                        alt="Imagen de la categoría <?php print_r($categoria->categorias_nombre) ?>">
                                                <?php } else { ?>
                                                    <img src="/corte/product.png"
                                                        alt="Imagen de la categoría <?php print_r($categoria->categorias_nombre) ?>">
                                                <?php } ?>


                                                <h5>
                                                    <?php

                                                    $resultado = separarPrimeraPalabra($categoria->categorias_nombre);

                                                    if ($resultado !== false) {
                                                        [$primeraPalabra, $restoFrase] = $resultado;
                                                        echo "<span> $primeraPalabra </span><br>";
                                                        echo $restoFrase;
                                                    } else {
                                                        echo $categoria->categorias_nombre;
                                                    }

                                                    ?>
                                                </h5>


                                            </div>

                                        </a>
                                    </div>
                                <?php } ?>

                            </div>
                        <?php } ?>


                    </div>
                </div>

            </div>
    </div>
</div>

<?php
function separarPrimeraPalabra($texto)
{
    $palabras = explode(' ', $texto);

    if (count($palabras) > 1) {
        return explode(' ', $texto, 2);
    } else {
        return false;
    }
}

// Ejemplo de uso:


?>

<div class="d-none">
    <?php
    if (APPLICATION_ENV == 'production' && 1 == 0) {
    ?>
        <iframe
            src="https://express.clubelnogal.com/page/login/loginauto/?cedula=<?php echo $_SESSION['kt_cedula']; ?>&level=<?php echo $_SESSION['kt_login_level']; ?>&celular=<?php echo $_SESSION['kt_celular']; ?>&email=<?php echo $_SESSION['kt_correo']; ?>&a=<?php echo $_SESSION['kt_accion']; ?>&q=<?php echo $_SESSION['quien_accion']; ?>&nombre=<?php echo $_SESSION['kt_nombre']; ?>"></iframe>
        <iframe
            src="https://cafeparis.clubelnogal.com/page/login/loginauto/?cedula=<?php echo $_SESSION['kt_cedula']; ?>&level=<?php echo $_SESSION['kt_login_level']; ?>&celular=<?php echo $_SESSION['kt_celular']; ?>&email=<?php echo $_SESSION['kt_correo']; ?>&a=<?php echo $_SESSION['kt_accion']; ?>&q=<?php echo $_SESSION['quien_accion']; ?>&nombre=<?php echo $_SESSION['kt_nombre']; ?>"></iframe>
    <?php
    }
    ?>
</div>
<?php if ($this->popup->publicidad_estado == 1) { ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const popup = document.getElementById("popup");
            if (popup) {
                const modal = new bootstrap.Modal(popup);
                modal.show();
            }
        });
    </script>
<?php } ?>
<!-- Modal PopUp -->
<?php if ($this->popup->publicidad_estado == 1) { ?>
    <div class="modal fade" id="popup" tabindex="-1" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style=" border: none;
		background-color: transparent;">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"
                    style="filter: invert(1);"></button>
                <div class="modal-body">
                    <?php if ($this->popup->publicidad_video != "") { ?>
                        <div class="fondo-video-youtube">
                            <div class="banner-video-youtube" id="videobanner<?php echo $this->popup->publicidad_id; ?> "
                                data-video="<?php echo $this->id_youtube($this->popup->publicidad_video); ?>"></div>
                        </div>
                    <?php } ?>
                    <?php if ($this->popup->publicidad_imagen != "") { ?>
                        <?php if ($this->popup->publicidad_enlace != "") { ?> <a href="<?php echo $this->popup->publicidad_enlace ?>"
                                <?php if ($this->popup->publicidad_tipo_enlace == 1) {
                                    echo "target='_blank'";
                                } ?>> <?php } ?><img
                                class="w-100 img-fluid d-none d-md-block img-popup" src="/images/<?php echo $this->popup->publicidad_imagen ?>"
                                alt="Imagen PopUp <?= $this->popup->publicidad_nombre ?>">
                            <img class="w-100 img-fluid d-block d-md-none"
                                src="/images/<?php echo $this->popup->publicidad_imagenresponsive ?>"
                                alt="Imagen PopUp <?= $this->popup->publicidad_nombre ?>">
                            <?php if ($this->popup->publicidad_enlace != "") { ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>