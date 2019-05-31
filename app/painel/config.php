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
	define("BASE_URL", "http://lustresecia.pc/admin/");
	define("BASE_PAINEL", "http://lustresecia.pc/painel/");
	define("BASE_SITE", "http://lustresecia.pc/");
	define("BASE_MEDIA", BASE_SITE . "/store/media/products/");
	$config['dbname'] = 'lustresecia_com_br_1';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	define("BASE_URL", "http://www.lustresecia.com.br/admin/");
	define("BASE_PAINEL", "http://www.lustresecia.com.br/painel/");
	define("BASE_SITE", "http://www.lustresecia.com.br/");
	define("BASE_MEDIA", BASE_URL . "/media/products/");
	$config['dbname'] = 'lustresecia_com_br_1';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'lustres643';
	$config['dbpass'] = 'T1b41302';
}

$db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set("America/Sao_Paulo");


// DADOS PARA ENVIO DE EMAILS DO SISTEMA

	// Server Settings
	$config['host'] = "smtp.gmail.com";
	$config['username'] = "fernando.tiburcio@gmail.com";
	$config['password'] = "#11123277#";
	$config['mail_port'] = 587;

	// Recipients
	$config['from'] = "fernando.tiburcio@gmail.com";
	$config['addReplyTo'] = "replyto@lustresecia.com.br";
