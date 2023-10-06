<?php
class ProductoView{

    //Mostrar porudctos por una categoria dada (Lado del front)
    public function mostrarProductosXCategoria($productos){
        require("templates/productos.phtml");
    }


    //Funcion encargada de manejar errores
    function mostrarError($error){
        require_once("templates/error.phtml");
    }
}