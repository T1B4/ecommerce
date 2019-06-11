<?php

require 'environment.php';

global $config;
global $db;

define("BASE_DIR", realpath(__DIR__));

$config = [];

if (ENVIRONMENT == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    ini_set("default.timezone", "America/Sao_Paulo");
    define("BASE_URL", "http://ecommerce.pc/store/");
    define("ROOT_URL", "http://ecommerce.pc/");
    $config['dbname'] = 'ecommerce';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = '';
} else {
    define("BASE_URL", "https://www.ecommerce.com.br/store/");
    define("ROOT_URL", "https://www.ecommerce.com.br/");
    ini_set("default.timezone", "America/Sao_Paulo");
    $config['dbname'] = 'ecommerce';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'lustres643';
    $config['dbpass'] = 'T1b41302';
}

$db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set("America/Sao_Paulo");

$config['default_lang'] = 'pt-br';
$config['cep_origin'] = '17201460';

//DADOS PARA CALCULO FRENET
$config['token_frenet'] = '48D05845RD1FBR4E8CRB5C8RAD3AF161D97B';
$config['senha_frenet'] = 'kQ3kPRw3g5L2+A7vK5iHLQ==';
$config['key_frenet'] = 'ecommerce_key';

$config['pagseguro_seller'] = 'fernando.tiburcio@hotmail.com';

\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("ecommerce")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("ecommerce")->setRelease("1.0.0");

\PagSeguro\Configuration\Configure::setEnvironment('sandbox');
\PagSeguro\Configuration\Configure::setAccountCredentials('fernando.tiburcio@hotmail.com', 'C2D1D351490D4FB9A0F88B0EB09AB0BA');
\PagSeguro\Configuration\Configure::setCharset('UTF-8');
\PagSeguro\Configuration\Configure::setLog(true, 'pagseguro-data.log');

// DADOS PARA ENVIO DE EMAILS DO SISTEMA

// Server Settings
$config['host'] = "ecommerce.com.br";
$config['username'] = "atendimento@ecommerce.com.br";
$config['password'] = "t1b40111";
$config['mail_port'] = 465;

// Recipients
$config['from'] = "atendimento@ecommerce.com.br";
$config['addReplyTo'] = "atendimento@ecommerce.com.br";
