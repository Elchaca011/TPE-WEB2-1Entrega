<?php
class ProductoView{

    public function mostrarProductos($productos){
        require("templates/productos.phtml");
    }

    //funcion encargada de mostrar porudctos por una categoria dada (Lado del front)
    public function mostrarProductosXCategoria($productos){
        require("templates/productosXCategoria.phtml");
    }

    //funcion encargada de mostrar el detalle de un producto determinado
    public function mostrarDetalle($producto){
        require("templates/detalleProducto.phtml");
    }


    //esta funcion es la encargada de manejar errores
    public function mostrarError($error){
        require_once("templates/error.phtml");
    }
}