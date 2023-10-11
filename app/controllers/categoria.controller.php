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
        //AutenHelper::verificar();
        $this->model = new CategoriaModel;
        $this->view = new CategoriaView;
    }

    //metodos:

    public function mostrarCategorias(){
        //obtengo las categorias de la base de datos (model)
        $categorias = $this->model->getCategorias();

        //muestro las categorias(view)
        $this->view->mostrarCategorias($categorias);
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
        $this->model->eliminarCategoria($id);
        header("location: ". BASE_URL . "categorias" );
    }
    
    //funcion para modificar categoria (atributo fragil)
    public function modificarCategoria($id){
        $this->model->modificarCategoria($id);
        header("location: ". BASE_URL . "/categorias" );
    }
}