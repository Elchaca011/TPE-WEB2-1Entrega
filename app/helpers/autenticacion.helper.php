<?php 
    class AutenHelper{
        public static function inicioSesion(){
            if(session_status()!= PHP_SESSION_ACTIVE){
                session_start();
            }
        }

        public static function login($usuario){
            //Corrobora que la sesion este iniciada()
            AutenHelper::inicioSesion();
            $_SESSION["USER_ID"] = $usuario->id_usuario;
            $_SESSION["USER_NAME"] = $usuario->nombre;
        }

        public static function logOut(){
            AutenHelper::inicioSesion();
            session_destroy();
        }

        public static function verificar(){
            AutenHelper::inicioSesion();

            if(!isset($_SESSION["id_usuario"])){
                header("location".BASE_URL."login");
                die();
            }
        }

    }