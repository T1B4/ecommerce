<?php

class Core
{

    public function run()
    {
        $url = (isset($_GET['q']) ? $_GET['q'] : '');
        $params = array();
        $x = explode('/', $url);
        if ($url === 'painel/') {
          array_shift($x);
        }

        if (count($x) >= 2) {
            $url = explode('/', $url);
            array_shift($url);

            $currentController = $url[0] . 'Controller';
            array_shift($url);

            if (isset($url[0]) && $url[0] != '/') {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }

            if (count($url) > 0) {
                $params = $url;
            }
        } elseif(count($x) < 2) {
            $currentController = 'homeController';
            $currentAction = 'index';
        }

        if (!file_exists(BASE_DIR . '/' . 'controllers/' . $currentController . '.php')) {
            $currentController = 'notFoundController';
            $currentAction = 'index';
        }

        $c = new $currentController();

        if (!method_exists($c, $currentAction)) {
            $currentAction = 'index';
        }

        call_user_func_array(array($c, $currentAction), $params);
    }

}
