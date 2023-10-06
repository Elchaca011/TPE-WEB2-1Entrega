<?php
class CategoriaView{

    //Mostrar categorias (Lado del front)
    public function mostrarCategorias($categorias){
        require("templates/categorias.phtml");
    }


    //Funcion encargada de manejar errores
    function mostrarError($error){
        require_once("templates/error.phtml");
    }
}