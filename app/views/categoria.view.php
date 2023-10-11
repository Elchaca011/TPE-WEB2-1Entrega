<?php
class CategoriaView{

    //esta funcion muestra las categorias (Lado del front)
    public function mostrarCategorias($categorias){
        require("templates/categorias.phtml");
    }


    //esta funcion es la encargada de manejar errores
    function mostrarError($error){
        require_once("templates/error.phtml");
    }
}