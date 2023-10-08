<?php
class ProductoView{

    public function mostrarProductos($productos){
        require("templates/productos.phtml");
    }

    //Mostrar porudctos por una categoria dada (Lado del front)
    public function mostrarProductosXCategoria($productos){
        require("templates/productosXCategoria.phtml");
    }

    public function mostrarFormularioProductos(){
        require_once ("templates/formularioProductos.phtml");
    }

    //Funcion encargada de manejar errores
    public function mostrarError($error){
        require_once("templates/error.phtml");
    }
}