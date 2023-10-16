<?php

require_once("app/models/categoria.model.php");
require_once("app/views/categoria.view.php");
require_once("app/helpers/autenticacion.helper.php");

class CategoriaController{
    //atributos
    private $model;
    private $view;

    //constructor
    public function __construct(){
        //Verifico que el usuario este logueado
        $this->model = new CategoriaModel;
        $this->view = new CategoriaView;
    }

    //metodos:

    public function mostrarCategorias(){
        //verifico que el usuario este logeado para mostrarle o no determinadas funcionalidades dentro de la pagina
        $esAdmin = AutenHelper::esAdmin();
        //obtengo las categorias de la base de datos (model)
        $categorias = $this->model->getCategorias();

        //muestro las categorias(view)
        $this->view->mostrarCategorias($categorias , $esAdmin);
    }

    public function agregarCategoria(){
        //obtengo los datos del usuario
        $categoria = $_POST["categoria"];
        $fragil = $_POST["fragil"];


        //validaciones
        foreach($_POST as $item){
            if(empty($item)){
                //si alguno de los campos esta vacio muestro por pantalla el error (responsabilidad del view)
                $this->view->mostrarError("Debe completar todos los campos");
                return;
            }
        }

        $id = $this->model->agregarCategoria($categoria,$fragil);
        
        if($id){
            //redirigo al usuario a la pantalla de categorias
            header("location: ". BASE_URL . "categorias" );
        }else{
            $this->view->mostrarError("los datos no pueden ser cargados");
        }
    }

    public function eliminarCategoria($id){
        //bloque try catch para manejar la excepcion de no poder borrar una categoria con productos cargados
        try{
            $this->model->eliminarCategoria($id);
            header("location: ". BASE_URL . "categorias" );
        }catch(Exception){
            $this->view->mostrarError("No se puede eliminar una categoria que tenga productos cargados!");
        }
    }

    public function formModificarCategoria($id){
        //obtengo la categoria pasada por parametro
        $categoria = $this->model->getCategoriaById($id);
        //muestro el formulario para poder modificar dicha categoria
        $this->view->mostrarformModCategoria($categoria);
    }
    
    //funcion para modificar categoria 
    public function modificarCategoria($id){
        //obtengo los datos que quiere modificar el usuario
        $categoria = $_POST["categoria"];
        $fragil = $_POST["fragil"];

        //validaciones
        foreach($_POST as $item){
            if(empty($item)){
                //si alguno de los campos esta vacio muestro por pantalla el error (responsabilidad del view)
                $this->view->mostrarError("Debe completar todos los campos");
                return;
            }
        }

        $this->model->modificarCategoria($id, $categoria, $fragil);
        header("location: ". BASE_URL . "categorias" );
    }
}