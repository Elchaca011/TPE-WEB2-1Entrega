<?php
require_once("config.php");

class UsuarioModel{

    private $db;

    public function __construct(){
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_Charset , DB_USER , DB_PASS);
    }

    public function obtenerNombre($nombre){
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $query->execute([$nombre]);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
}