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

    //metodos

    public function mostrarProductos(){
        //obtengo los productos de la db
        $productos = $this->model->getProductos();
        //muestro los productos (view)
        $this->view->mostrarProductos($productos);
    }

    public function mostrarProductoXCategoria($id_fk){
        //obtengo los productos de una categoria determinada de la base de datos
        $productos = $this->model->getProductosXCategoria($id_fk);

        //muestro esos productos (view)
        $this->view->mostrarProductosXCategoria($productos);
    }

    public function mostrarDetalleProducto($id){
        //obtengo un determinado producto para ver sus detalles
        $producto = $this->model->getProducto($id);

        //muestro el detalle de ese producto
        $this->view->mostrarDetalle($producto);
    }

    //funcion que inserta un nuevo producto en la base de datos
    public function agregarProducto(){

        //obtengo los datos del usuario 
        $id_categoria = $_POST["id_categoria"];
        $nombre = $_POST["nombre"];
        $material = $_POST["material"];
        $color = $_POST["color"];
        $precio = $_POST["precio"];

        //validaciones
        foreach($_POST as $item){
            if(empty($item)){
                //si alguno de los campos esta vacio muestro por pantalla el error (responsabilidad del view)
                $this->view->mostrarError("Debe completar todos los campos");
                return;
            }
        }

        $id = $this->model->agregarProducto($id_categoria,$nombre,$material,$color,$precio);
        
        if($id){
            //redirigo al usuario a la pantalla de productos
            header("location:" . BASE_URL ."mostrarProductos" );
        }else{
            $this->view->mostrarError("los datos no pueden ser cargados");
        }
    }

    public function eliminarProducto($id){
        $this->model->eliminarProducto($id);
        header("location:" . BASE_URL ."mostrarProductos");
    }

}