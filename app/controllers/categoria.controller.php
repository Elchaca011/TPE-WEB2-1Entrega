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
        $esAdmin = AutenHelper::esAdmin();
        //verifica que un usuario no logeado no pueda acceder a estas acciones.
        if($esAdmin){
            //obtengo los datos del usuario
            $categoria = $_POST["categoria"];
            $fragil = $_POST["fragil"];


            //validaciones
            if(empty($categoria) || !($fragil==true || $fragil==false)){
                //si alguno de los campos esta vacio muestro por pantalla el error (responsabilidad del view)
                $this->view->mostrarError("Debe completar todos los campos");
                return;    
            }

            $id = $this->model->agregarCategoria($categoria,$fragil);
            
            if($id){
                //redirigo al usuario a la pantalla de categorias
                header("location: ". BASE_URL . "categorias" );
            }else{
                $this->view->mostrarError("los datos no pueden ser cargados");
            }
        }
        else{
            $this->view->mostrarError("No tenes permisos suficientes");
        }
    }

    public function eliminarCategoria($id){
        $esAdmin = AutenHelper::esAdmin();
        if($esAdmin){
            //bloque try catch para manejar la excepcion de no poder borrar una categoria con productos cargados
            try{
                $this->model->eliminarCategoria($id);
                header("location: ". BASE_URL . "categorias" );
            }catch(Exception){
                $this->view->mostrarError("No se puede eliminar una categoria que tenga productos cargados!");
            }
        }
        else{
            $this->view->mostrarError("No tenes permisos suficientes");
        }
    }

    public function formModificarCategoria($id){
        $esAdmin = AutenHelper::esAdmin();
        if($esAdmin){
            //obtengo la categoria pasada por parametro
            $categoria = $this->model->getCategoriaById($id);
            //muestro el formulario para poder modificar dicha categoria
            $this->view->mostrarformModCategoria($categoria);
        }
        else{
            $this->view->mostrarError("No tenes permisos suficientes");
        }
    }
    
    //funcion para modificar categoria 
    public function modificarCategoria($id){
        $esAdmin = AutenHelper::esAdmin();
        if($esAdmin){
            //obtengo los datos que quiere modificar el usuario
            $categoria = $_POST["categoria"];
            $fragil = $_POST["fragil"]; 

            //validaciones
            if(empty($categoria) || !($fragil==true || $fragil==false)){
                //si alguno de los campos esta vacio muestro por pantalla el error (responsabilidad del view)
                $this->view->mostrarError("Debe completar todos los campos");
                return;    
            }

            $this->model->modificarCategoria($id, $categoria, $fragil);
            header("location: ". BASE_URL . "categorias" );
        }
        else{
            $this->view->mostrarError("No tenes permisos suficientes");
        }
    }
}