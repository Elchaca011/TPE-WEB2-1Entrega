<?php
class CategoriaView{

    //esta funcion muestra las categorias (Lado del front)
    public function mostrarCategorias($categorias, $esAdmin = false){
        require_once("templates/categorias.phtml");
    }

    //esta funcion muestra el formulario para poder modificar una categoria pasada por parametros
    public function mostrarFormModCategoria($categoria){
        require_once "templates/formularioModCategoria.phtml";
    }


    //esta funcion es la encargada de manejar errores
    function mostrarError($error){
        require_once("templates/error.phtml");
    }
}