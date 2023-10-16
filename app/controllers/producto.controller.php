<?php
require_once("app/models/producto.model.php");
require_once("app/views/producto.view.php");

class ProductoController{
    //atributos
    private $model;
    private $view;
    private $categoriaModel;

    //constructor
    public function __construct(){
        $this->model = new ProductoModel;
        $this->view = new ProductoView;
        $this->categoriaModel = new CategoriaModel;
    }

    //metodos

    public function mostrarProductos(){
        //verifico que el usuario este logeado para mostrarle o no determinadas funcionalidades dentro de la pagina
        $esAdmin = AutenHelper::esAdmin();
        //obtengo los productos de la db
        $productos = $this->model->getProductos();

        //obtengo las categorias 
        $categorias = $this->categoriaModel->getCategorias();
        //muestro los productos 
        $this->view->mostrarProductos($productos, $categorias, $esAdmin);
    }

    public function mostrarProductoXCategoria($id_fk){
        //obtengo los productos de una categoria determinada de la base de datos
        $productos = $this->model->getProductosXCategoria($id_fk);

        //muestro esos productos 
        $this->view->mostrarProductosXCategoria($productos);
    }

    public function mostrarDetalleProducto($id){
        //obtengo un determinado producto para ver sus detalles
        $producto = $this->model->mostrarDetalleProducto($id);

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

    //funcion que muestra el formulario para modificar un determinado producto
    public function formModificarProducto($id){
        //obtengo las categorias para que del formulario se pueda modificar 
        $categorias = $this->categoriaModel->getCategorias();
        //obtengo el producto que quiero modificar 
        $producto = $this->model->getProductoById($id);
        //muestro el formulario para modificar dicho prodcuto
        $this->view->mostrarFormModProducto($producto, $categorias);
    }

    //funcion para modificar un determinado producto
    public function modificarProducto($id){
        //obtengo los datos del formulario
        $categoria = $_POST["id_categoria"];
        $nombre = $_POST["nombre"];
        $material = $_POST["material"];
        $color = $_POST["color"];
        $precio = $_POST["precio"];

        //valido los datos
        foreach($_POST as $item){
            if(empty($item)){
                $this->view->mostrarError("Debe completar todos los datos");
                return;
            }
        }

        $this->model->modificarProducto($id, $categoria, $nombre, $material, $color, $precio);
        header("location:" . BASE_URL . "mostrarProductos");
    }

}