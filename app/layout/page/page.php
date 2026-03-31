<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>
		<?= $this->_titlepage ?>
	</title>
	<meta name="description" content="<?= $this->_data['metadescription']; ?>" />
	<meta name="keywords" content="<?= $this->_data['metakeywords']; ?>" />
	<!-- Jquery -->

	<script src="/components/jquery/jquery-3.6.0.min.js"></script>
	<!-- <script src="/components/jquery/dist/jquery.min.js"></script> -->

	<link rel="stylesheet" type="text/css" href="/scripts/carousel/carousel.css">
	<!-- <link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css"> -->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/components/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/skins/page/css/global.css?v=5.01">
	<link rel="stylesheet" href="/skins/page/css/responsive.css?v=5.01">

	<!-- FontAwesome -->
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
	<link rel="stylesheet" href="/components/Font-Awesome/css/all.css">
	<!-- Slick -->
	<script type="text/javascript" src="/components/slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/components/slick/slick.css" />
	<link rel="stylesheet" type="text/css" href="/components/slick/slick-theme.css" />

	<!-- Rating stars -->
	<script src="/components/stars/src/jquery.star-rating-svg.js"></script>
	<link rel="stylesheet" type="text/css" href="/components/stars/src/css/star-rating-svg.css">
	<!-- SweetAlert -->
	<script src="/components/sweetalert/sweetalert2@11.js"></script>

	<link rel="shortcut icon" href="/favicon.ico">
	<!--<script type="text/javascript" id="www-widgetapi-script"-->
	<!--	src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflS50iB-/www-widgetapi.js" async=""></script>-->
	<!--<?php if (1 == 0) { ?>-->
	<!--	<script src="https://www.youtube.com/player_api"></script>-->
	<!--<?php } ?>-->
	<?= $this->_data['info_pagina_scripts']; ?>
	<meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>
	<header>
		<?= $this->_data['header']; ?>
	</header>
	<main class="main-content">
		<?= $this->_content ?>
	</main>
	<footer>
		<?= $this->_data['footer']; ?>
	</footer>
	<!-- <script src="/components/jquery/dist/jquery.min.js"></script> -->
	<script src="/components/jquery/jquery-3.6.0.min.js"></script>
	<!-- Popper -->
	<!-- <script src="https://unpkg.com/@popperjs/core@2"></script> -->
	<!-- <script src="/scripts/popper.min.js?v=1.00"></script> -->
	<!-- <script src="/components/bootstrap/dist/js/bootstrap.min.js"></script> -->
	<!-- Bootstrap Js -->
	<script src="/components/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="/scripts/carousel/carousel.js"></script>
	<script src="/components/bootstrap-validator/dist/validator.min.js"></script>
	<script src="/skins/page/js/main.js?v=3.17"></script>
	<?php if ($this->_data['ocultarcarrito'] != 1) { ?>
		<div id="micarrito"></div>
	<?php } ?>
</body>

</html>