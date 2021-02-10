<?php


class Core
{ // class begin
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];
    // constructor
    /**
     * Core constructor.
     */
    public function __construct()
    {
        $url = $this->getUrl();
        $controllerName = ucwords($url[0]);
        $cotrollerFile = '../app/controllers/'.$controllerName.'.php';
        if(file_exists($cotrollerFile)){
            $this->currentController = $controllerName;
            unset($url[0]);
        }
        require_once  '../app/controllers/'. $this->currentController.'.php';
        $this->currentController = new  $this->currentController;
        print_r($this->currentController);
        print_r($url);
    }

    // get url data
    public function  getUrl() {
        if(isset($_GET['url'])){
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = htmlentities($url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
} // class end