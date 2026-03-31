<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?= $this->_titlepage ?>
    </title>
    <!-- Jquery -->
    <script src="/components/jquery/jquery-3.6.0.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYVxdF4VwIPfmB65X2kMt342GbUXApwQ&sensor=true">
    </script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/components/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="/components/bootstrapOLD/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="/components/bootstrap-fileinput/css/fileinput.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="/components/Font-Awesome/css/all.css">

    <link href="/components/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="/components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet">
    <link rel="stylesheet" href="/skins/administracion/css/global.css?v=1.02">
     <style>
        #panel-botones,
        #contenido_panel {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1), max-width 0.3s cubic-bezier(0.4, 0, 0.2, 1);

            /* transform: translateX(0); */


        }

        #panel-botones {
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        #contenido_panel {
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .menu-cerrado {
            width: 0 !important;
            min-width: 0 !important;
            overflow: hidden !important;
            padding: 0 !important;
            border: none !important;
            visibility: hidden;
            max-width: 0% !important;
            transform: translateX(-100%) !important;
            /* Mueve el panel fuera de vista */
        }

        .contenido-expandido {
            width: 100% !important;
            max-width: 100% !important;
            flex: 1 !important;
            /* Cambia a 1 para expandir */
            transform: translateX(0) !important;
            /* Asegura posición normal */
        }
    </style>

    <script type="text/javascript">
        var map;
        var longitude = 0;
        var latitude = 0;
        var icon = '/skins/administracion/images/ubicacion.png';
        var point = false;
        var zoom = 10;

        function setValuesMap (longitud, latitud, punto, zoomm, icono) {
            longitude = longitud;
            latitude = latitud;
            if (punto) {
                point = punto;
            }
            if (zoomm) {
                zoom = zoomm;
            }
            if (icono) {
                icon = icono
            }
        }

        function initializeMap () {
            var mapOptions = {
                zoom: parseInt(zoom),
                center: new google.maps.LatLng(longitude, longitude),
            };
            // Place a draggable marker on the map
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            if (point == true) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(longitude, latitude),
                    map: map,
                    icon: icon
                });
            }
            map.setCenter(new google.maps.LatLng(longitude, latitude));
        }
    </script> 

</head>

<body>
    <header class="sticky-top z-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-3 d-flex align-items-center">
                    <button id="toggle-menu" class="btn me-3" type="button"
                        style="border:none;background:transparent;color:#fff;">
                        <span style="font-size:2rem;line-height:1;">
                            <i id="icon-menu" class="fas fa-bars"></i>
                        </span>
                    </button>
                    <img src="/skins/administracion/images/logo-new.png" class="logo-blanco" style="height: 60px;">
                </div>
                <div class="col-9">
                    <?= $this->_data['panel_header']; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="panel-botones" class="col-2">
                <?= $this->_data['panel_botones']; ?>
            </nav>
            <article id="contenido_panel" class="col-10">
                <section id="contenido_general">

                    <?= $this->_content ?>
                </section>
            </article>
        </div>
    </div>
    <footer class="panel-derechos col-md-12">&copy;<?= date('Y') ?> Todos los derechos reservados |
        info@omegawebsystems.com - 318
        642 5229 - 350 708 7228 | Diseñado por <a href="http://www.omegasolucionesweb.com" target="_blank">OMEGA
            SOLUCIONES WEB</a>
    </footer>

    <!-- <script src="/scripts/popper.min.js"></script> -->
    <!-- Bootstrap Js -->
    <script src="/components/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="/components/bootstrapOLD/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="/components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="/components/bootstrap-fileinput/js/locales/es.js"></script>
    <script src="/components/tinymce/tinymce.min.js"></script>
    <script src="/components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    <script src="/skins/administracion/js/main.js?v=1.02"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var btn = document.getElementById('toggle-menu');
            var panelBotones = document.getElementById('panel-botones');
            var contenidoPanel = document.getElementById('contenido_panel');
            btn.addEventListener('click', function () {
                if (!panelBotones.classList.contains('menu-cerrado')) {
                    panelBotones.classList.add('menu-cerrado');
                    contenidoPanel.classList.add('contenido-expandido');
                } else {
                    panelBotones.classList.remove('menu-cerrado');
                    contenidoPanel.classList.remove('contenido-expandido');
                }
            });
        });
    </script>
</body>

</html>