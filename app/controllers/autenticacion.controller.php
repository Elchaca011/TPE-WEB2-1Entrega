<?php
require_once("app/views/autenticacion.view.php");
require_once("app/models/usuario.model.php");
require_once("app/helpers/autenticacion.helper.php");


class AutenticacionController{
    private $view;
    private $model;

    public function __construct(){
        $this->view = new AutenticacionView();
        $this->model = new UsuarioModel();
    }

    public function mostrarLogin(){
        $this->view->mostrarLogin();

    }

    public function autenticacion(){
        $nombre = $_POST["nombreUsuario"];
        $contrasenia = $_POST["contrasenia"];

        if(empty($nombre) || empty($contrasenia)){
            $this->view->mostrarError("Falta completar campos");
            return;
        }
        //Busco el usuario
        $usuario = $this->model->obtenerNombre($nombre);
        if($usuario && password_verify($contrasenia, $usuario->password)){
            
            //Aca lo autentique
            AutenHelper::login($usuario);

            //Redirecciono al home
            header("location:".BASE_URL."categorias");
        }
        else{
            $this->view->mostrarError("Usuario invalido");
        }
    }

    public function logout(){
        AutenHelper::logout();
        
        //Redirecciono al home
        header("location:".BASE_URL."home");
    }
}