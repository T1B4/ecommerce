<?php

session_start();

@$url = explode('/' , $_GET['q']);

if (empty($_GET['q']) || $url[0] !== 'painel') {

    spl_autoload_register(function ($class) {
        require_once '../app/store/vendor/autoload.php';
        require_once '../app/store/config.php';
        require_once '../app/store/routers.php';
        if (file_exists(BASE_DIR . '/' . 'controllers/' . $class . '.php')) {
            require_once BASE_DIR . '/' . 'controllers/' . $class . '.php';
        } elseif (file_exists(BASE_DIR . '/' . 'models/' . $class . '.php')) {
            require_once BASE_DIR . '/' . 'models/' . $class . '.php';
        } elseif (file_exists(BASE_DIR . '/' . 'core/' . $class . '.php')) {
            require_once BASE_DIR . '/' . 'core/' . $class . '.php';
        } elseif (file_exists(BASE_DIR . '/' . 'controllers/helpers/' . $class . '.php')) {
            require_once BASE_DIR . '/' . 'controllers/helpers/' . $class . '.php';
        }
    });
} else {
  
    require_once '../app/painel/vendor/autoload.php';
    require_once '../app/painel/config.php';

    spl_autoload_register(function ($class) {
        if (file_exists(BASE_DIR . '/' . 'controllers/' . $class . '.php')) {
            require_once BASE_DIR . '/' . 'controllers/' . $class . '.php';
        } elseif (file_exists(BASE_DIR . '/' . 'models/' . $class . '.php')) {
            require_once BASE_DIR . '/' . 'models/' . $class . '.php';
        } elseif (file_exists(BASE_DIR . '/' . 'core/' . $class . '.php')) {
            require_once BASE_DIR . '/' . 'core/' . $class . '.php';
        }
    });
}
$core = new Core();
$core->run();
