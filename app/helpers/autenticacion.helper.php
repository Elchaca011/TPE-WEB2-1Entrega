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
            $_SESSION["id_usuario"] = $usuario->id_usuario;
            $_SESSION["nombre"] = $usuario->nombre;
        }

        public static function logout(){
            AutenHelper::inicioSesion();
            session_destroy();
        }

        public static function esAdmin(){
            AutenHelper::inicioSesion();
            return !empty($_SESSION["id_usuario"]);
        }
    }