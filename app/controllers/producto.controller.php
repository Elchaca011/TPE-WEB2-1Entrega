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
    public function mostrarProductos(){
        //obtengo los productos de la db
        $productos = $this->model->getProductos();
        //Muestro los productos (view)
        $this->view->mostrarProductos($productos);
    }

    public function mostrarProductoXCategoria($id_fk){
        //Obtengo los productos de una categoria determinada de la base de datos
        $productos = $this->model->getProductosXCategoria($id_fk);

        //Muestro esos productos
        $this->view->mostrarProductosXCategoria($productos);
    }

    //funcion que inserta un nuevo producto en la base de datos
    public function agregarProducto(){

        //obtengo los datos del usuario 
        $id_categoria = $_POST["id_categoria"];
        $nombre = $_POST["nombre"];
        $material = $_POST["material"];
        $precio = $_POST["precio"];

        //Validaciones
        foreach($_POST as $item){
            if(empty($item)){
                //Si alguno de los campos esta vacio muestro por pantalla el error (responsabilidad del view)
                $this->view->mostrarError("Debe completar todos los campos");
                return;
            }
        }

        $id = $this->model->agregarProducto($id_categoria,$nombre,$material,$precio);
        
        if($id){
            //Redirigo al usuario a la pantalla principal
            header("location: ". BASE_URL );
        }else{
            $this->view->mostrarError("los datos no pueden ser cargados");
        }
    }

}