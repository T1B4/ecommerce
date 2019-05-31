<?php

require 'environment.php';
// require '../directory.php';

global $config;
global $db;

define("BASE_DIR", __DIR__);

$config = [];

if(ENVIRONMENT == 'development') {
	error_reporting(E_ALL);
	ini_set("display_errors", "On");
	define("BASE_URL", "http://ecommerce.pc/admin/");
	define("BASE_PAINEL", "http://ecommerce.pc/painel/");
	define("BASE_SITE", "http://ecommerce.pc/");
	define("BASE_MEDIA", BASE_SITE . "/store/media/products/");
	$config['dbname'] = 'ecommerce';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	define("BASE_URL", "http://www.ecommerce.com.br/admin/");
	define("BASE_PAINEL", "http://www.ecommerce.com.br/painel/");
	define("BASE_SITE", "http://www.ecommerce.com.br/");
	define("BASE_MEDIA", BASE_URL . "/media/products/");
	$config['dbname'] = 'ecommerce';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'ecomm_001';
	$config['dbpass'] = 'Mfgt0201';
}

$db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// DADOS PARA ENVIO DE EMAILS DO SISTEMA

	// Server Settings
	$config['host'] = "smtp.gmail.com";
	$config['username'] = "fernando.tiburcio@gmail.com";
	$config['password'] = "#11123277#";
	$config['mail_port'] = 587;

	// Recipients
	$config['from'] = "fernando.tiburcio@gmail.com";
	$config['addReplyTo'] = "replyto@ecommerce.com.br";
