<?php

class AutenticacionView{

    public function mostrarLogin(){
        require("templates/login.phtml");
    }

    public function mostrarError($error){
        require("templates/error.phtml");
    }
}