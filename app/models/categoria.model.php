<?php
//incluyo el config.php el cual se encarga de la conexion a la db
require_once("config.php");
class CategoriaModel{
    //atributo
    private $db;

    //constructor
    function __construct(){
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_Charset , DB_USER , DB_PASS);
    }

    //obtiene y devuelve de la base de datos todas las categorias.
    public function getCategorias(){
        //envio la consulta
        $query = $this->db->prepare("SELECT * FROM categorias");
        $query->execute();

        //$categorias es un arreglo de categorias
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    //inserta la categoria en la base de datos
    public function agregarCategoria($categoria, $fragil){

        //blindeo(Protego) los parametreos con VALUES(?,?) (seguridad)
        $query = $this->db->prepare("INSERT INTO categorias (categoria,fragil)VALUES(?,?)");
        $query->execute([$categoria,$fragil]);
    
        return $this->db->lastInsertId();
    }


    //elimina una categoria de la base de datos
    public function eliminarCategoria($id){
        $query = $this->db->prepare("DELETE FROM categorias WHERE id_categoria = ?");
        $query->execute([$id]);
    }

    //edita el atributo fragil de la base de datos
    public function modificarCategoria($id){
        $query = $this->db->prepare("UPDATE categorias SET fragil = 0 WHERE id_categoria = ?");
        $query->execute([$id]);
    }
}