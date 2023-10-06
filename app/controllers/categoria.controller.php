<?php

require_once("app/models/categoria.model.php");
require_once("app/views/categoria.view.php");

class CategoriaController{
    //atributos
    private $model;
    private $view;

    //constructor
    public function __construct(){
        $this->model = new CategoriaModel;
        $this->view = new CategoriaView;
    }

    //Metodos:

    public function mostrarCategorias(){
        //Obtengo las categorias de la base de datos (model)
        $categorias = $this->model->getCategorias();

        //Muestro las categorias (view)
        $this->view->mostrarCategorias($categorias);
    }

    public function agregarCategoria(){
        //Obtengo los datos del usuario
        $categoria = $_POST["categoria"];
        $fragil = $_POST["fragil"];


        //Validaciones
        foreach($_POST as $item){
            if(empty($item)){
                //Si alguno de los campos esta vacio muestro por pantalla el error (responsabilidad del view)
                $this->view->mostrarError("Debe completar todos los campos");
                return;
            }
        }

        $id = $this->model->agregarCategoria($categoria,$fragil);
        
        if($id){
            //Redirigo al usuario a la pantalla principal
            header("location: ". BASE_URL );
        }else{
            $this->view->mostrarError("los datos no pueden ser cargados");
        }

    }

    // Funcion para eliminar una categoria
    public function eliminarCategoria($id){
        $this->model->eliminarCategoria($id);
        header("location: ". BASE_URL );
    }
    
}