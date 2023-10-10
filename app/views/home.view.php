<?php
class HomeView{

    //metodos

    //muestro el home al usuario
    public function mostrarHome(){
        require_once("templates/home.phtml");
    }

    //si hay una url que no existe
    public function mostrar404($error){
        require_once("templates/error.phtml");
    }
}