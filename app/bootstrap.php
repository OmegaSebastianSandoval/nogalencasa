<?php 
ini_set('session.cookie_secure', '1');       // Solo enviar cookie por HTTPS
ini_set('session.cookie_httponly', '1');      // No accesible por JavaScript
ini_set('session.cookie_samesite', 'Strict'); // Previene CSRF entre sitios
header('X-Powered-By: Nogal');


session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',realpath(dirname(__FILE__)).DS);
define('FRAMEWORK_PATH', ROOT .'../framework'.DS);
define('APP_PATH', ROOT .'../app'.DS);
define('VIEWS_PATH', APP_PATH .'View'.DS);
define('LAYOUTS_PATH', APP_PATH .'layout'.DS);
define('IMAGE_PATH',APP_PATH."../public_html/images/");
define('FILE_PATH',APP_PATH."../public_html/files/");
define('PUBLIC_PATH',APP_PATH."../public_html/");

date_default_timezone_set('America/Bogota');

// // Seguridad bsica
// header("Referrer-Policy: strict-origin-when-cross-origin");
// header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
// header("X-Frame-Options: SAMEORIGIN");
// header("X-Content-Type-Options: nosniff");
// header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");

// // Política CSP
// $csp = "default-src 'self'; ".
//       "frame-ancestors 'self' https://www.google.com https://www.gstatic.com; ".
//       "base-uri 'self'; ".
//       "object-src 'none'; ".
//       "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://data.flmngr.com https://cdn.flmngr.com https://unpkg.com https://cloud.n1ed.com https://cloud.flmngr.com https://cdn.flmngr.com https://cdn.jsdelivr.net https://s.ytimg.com https://cdn.public.flmngr.com https://cdnjs.cloudflare.com https://maps.googleapis.com https://www.gstatic.com https://www.google.com https://www.youtube.com https://www.googletagmanager.com https://www.google-analytics.com; ".
//       "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://cdn.metroui.org.ua https://checkout.epayco.co https://secure.epayco.co https://www.gstatic.com; ".
//       "img-src 'self' data: blob: https://*; ".
//       "font-src 'self' data: https://fonts.gstatic.com https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; ".
//       "media-src 'self' blob: https://www.youtube.com https://s.ytimg.com; ".
//       "connect-src 'self' https://maps.googleapis.com https://cdn.jsdelivr.net/ https://data.flmngr.com https://cdn.flmngr.com https://cloud.flmngr.com https://www.google-analytics.com https://www.googletagmanager.com;";

// header("Content-Security-Policy: $csp");



require_once FRAMEWORK_PATH.'Config/Config.php';
set_include_path(
    implode(
        PATH_SEPARATOR,
        array(
            get_include_path(),
            FRAMEWORK_PATH
        )
    )
);

function framework_autoload($classname) {
	$ruta = explode('_',$classname);
    if(substr(end($ruta), -10) == 'Controller') {
        $file = strtolower($ruta[0]).'/Controllers/'.$ruta[1].'.php';
        if (file_exists(APP_PATH.'modules/'.$file)) {
            require_once(APP_PATH.'modules/'.$file);
        }
    } else if (isset($ruta[1]) && $ruta[1] == 'Model'){
        $file = strtolower($ruta[0])."/Models/";
        unset($ruta[0]);
        unset($ruta[1]);
        $file = $file.implode("/",$ruta).'.php';
        if (file_exists(APP_PATH.'modules/'.$file)) {
            require_once(APP_PATH.'modules/'.$file);
        }
    } else {
        $file = implode("/",$ruta).'.php';
        if (file_exists(APP_PATH.'../framework/'.$file)) {
            require_once($file);
        }
    }
}
spl_autoload_register('framework_autoload');

include(APP_PATH.'/../vendor/autoload.php');
$env = "development";
if(strpos($_SERVER['HTTP_HOST'],"nogalencasa.wsnogal.com") !== false){
    $env = "staging";
} else if(strpos($_SERVER['HTTP_HOST'],"nogalencasa.com") !== false){
    $env = "production";
}
define('APPLICATION_ENV', getenv('APPLICATION_ENV')?getenv('APPLICATION_ENV'):$env);
// echo APPLICATION_ENV;
error_reporting(E_STRICT);
if($_GET['debug']=="1"){
    error_reporting(E_ALL);
}
ini_set("display_errors", 1);

if (!file_exists(IMAGE_PATH)) {
    mkdir(IMAGE_PATH, 0777, true);
}

if (!file_exists(FILE_PATH)) {
    mkdir(FILE_PATH, 0777, true);
}

//require_once '../vendor/phpoffice/phpexcel/Classes/PHPExcel.php';
require '../vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/Spreadsheet.php';

require_once '../vendor/festivos/festivos.php';
if (isset($_GET['testiniomega'])) {
    header('Content-Type: text/plain; charset=utf-8');

    $directives = [
        'expose_php',
        'disable_functions',
        'display_errors',
        'log_errors',
        'session.cookie_httponly',
        'session.cookie_secure',
        'session.use_only_cookies',
        'session.cookie_samesite',
        'engine',
        'file_uploads',
        'upload_max_filesize',
        'post_max_size',
        'max_file_uploads',
        'allow_url_fopen',
        'allow_url_include',
        'max_input_time',
        'max_execution_time',
        'memory_limit'
    ];

    foreach ($directives as $d) {
        echo $d . ' = ' . ini_get($d) . PHP_EOL;
    }

    exit;
}