<?php
require_once("app/views/home.view.php");
class HomeController{
    //atributo
    private $view;

    //constructor
    public function __construct() {
        $this->view = new HomeView;
    }

    //metodos

    //funcion para mostrar el home
    public function mostrarHome(){
        $this->view->mostrarHome();
    }
}