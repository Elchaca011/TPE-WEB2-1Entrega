<?php
require_once("app/models/producto.model.php");
require_once("app/views/producto.view.php");

class ProductoController{
    //atributos
    private $model;
    private $view;

    //constructor
    public function __construct(){
        $this->model = new ProductoModel;
        $this->view = new ProductoView;
    }

    //Metodos
    public function mostrarProductoXCategoria($id_fk){
        //Obtengo los productos de una categoria determinada de la base de datos
        $productos = $this->model->getProductosXCategoria($id_fk);

        //Muestro esos productos
        $this->view->mostrarProductosXCategoria($productos);
    }

}