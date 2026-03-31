<?php
define('DEFAULT_TITLE', 'Nogal Delivery');// titulo general para toda la pagina

$config = array(); //

$config ['production']= array();
$config ['production']['db'] = array();
$config ['production']['db']['host'] ='localhost';
$config ['production']['db']['name'] ='';
$config ['production']['db']['user'] ='';
$config ['production']['db']['password'] ='';
$config ['production']['db']['port'] ='3306';
$config ['production']['db']['engine'] ='mysql';
$config ['production']['placetopay']['url'] ='https://secure.placetopay.com/redirection/';
$config ['production']['placetopay']['login'] ='8fd9ea3c020b0ec21010432ce5d3902b';
$config ['production']['placetopay']['tranKey'] ='8Jnz64tGIiMB155A';
$config ['production']['placetopay']['returnUrl'] ='https://delivery.clubelnogal.com/core/placetopay/response';

$config ['staging']= array();
$config ['staging']['db'] = array();
$config ['staging']['db']['host'] ='localhost';
$config ['staging']['db']['name'] ='networki_delivery';
$config ['staging']['db']['user'] ='networki_delivery';
$config ['staging']['db']['password'] ='ACHM?.PrcTXj';
$config ['staging']['db']['port'] ='3306';
$config ['staging']['db']['engine'] ='mysql';
$config ['staging']['placetopay']['url'] ='https://test.placetopay.com/redirection/';
$config ['staging']['placetopay']['login'] ='273adc85cdca97e46161404c0860dece';
$config ['staging']['placetopay']['tranKey'] ='erWdm76LA05r3844';
$config ['staging']['placetopay']['returnUrl'] ='http://delivery.networkingclubelnogal.com/core/placetopay/response';

$config ['development']= array();
$config ['development']['db'] = array();
$config ['development']['db']['host'] ='localhost';
$config ['development']['db']['name'] ='tiendaelnogal';
$config ['development']['db']['user'] ='root';
$config ['development']['db']['password'] = '';
$config ['development']['db']['port'] ='3306';
$config ['development']['db']['engine'] ='mysql';
$config ['development']['placetopay']['url'] ='https://test.placetopay.com/redirection/';
$config ['development']['placetopay']['login'] ='273adc85cdca97e46161404c0860dece';
$config ['development']['placetopay']['tranKey'] ='erWdm76LA05r3844';
$config ['development']['placetopay']['returnUrl'] ='http://delivery.networkingclubelnogal.com/core/placetopay/response';
