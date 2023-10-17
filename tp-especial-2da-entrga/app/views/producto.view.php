<?php
class ProductoView{

    public function mostrarProductos($productos, $categorias , $esAdmin = false){
        require_once("templates/productos.phtml");
    }

    //funcion encargada de mostrar porudctos por una categoria dada (Lado del front)
    public function mostrarProductosXCategoria($productos){
        require_once("templates/productosXCategoria.phtml");
    }

    //funcion encargada de mostrar el detalle de un producto determinado
    public function mostrarDetalle($producto){
        require_once("templates/detalleProducto.phtml");
    }

    //funcion para mostrar el formulario para modificar un determinado producto
    public function mostrarFormModProducto($producto, $categorias){
        require_once "templates/formularioModProducto.phtml";
    }


    //esta funcion es la encargada de manejar errores
    public function mostrarError($error){
        require_once("templates/error.phtml");
    }
}