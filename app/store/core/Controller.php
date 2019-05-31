<?php

class Controller
{

    protected $db;

    public function __construct()
    {
        global $config;
    }

    public function loadView($viewName, $viewData = array())
    {
        extract($viewData);
        include BASE_DIR . '/' . 'views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array())
    {
        $dados = array();
        include BASE_DIR . '/' . 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData)
    {
        extract($viewData);
        include BASE_DIR . '/' . 'views/' . $viewName . '.php';
    }

}
