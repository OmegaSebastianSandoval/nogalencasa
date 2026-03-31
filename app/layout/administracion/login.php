<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title><?= $this->_titlepage ?></title>

  <!-- <link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/components/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="/skins/administracion/css/global.css?v=1.02">
</head>

<body class="login-fondo">
  <div class="login-header">
    <img src="/skins/administracion/images/logo-horizontal.png">
  </div>
  <div class="login-caja">
    <div class="login-content p-0"><?= $this->_content ?></div>
    <div class="login-image">
      <img src="/skins/administracion/images/ilustracion-login.png" alt="">
    </div>
  </div>

 <div class="login-derechos">
    &copy; <?php echo date('Y') ?> Todos los derechos reservados | Diseñado por <a href="https://omegasolucionesweb.com" target="_blank">OMEGA SOLUCIONES WEB</a>
    <br>
    info@omegawebsystems.com - 318 642 5229 - 350 708 7228
  </div>

  <!-- <script src="/components/jquery/dist/jquery.min.js"></script> -->
  <script src="/components/jquery/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap Js -->
  <script src="/components/bootstrap/js/bootstrap.min.js"></script>
  <!-- <script src="/components/bootstrap/dist/js/bootstrap.min.js"></script> -->
  <script src="/components/bootstrap-validator/dist/validator.min.js"></script>
  <script src="/skins/administracion/js/main.js?v=1.02"></script>
</body>

</html>