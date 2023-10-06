<?php
class CategoriaModel{
    //Atributo
    private $db;

    //Constructor
    function __construct(){
        $this->db = new PDO("mysql:host=localhost;dbname=db_tpe;charset=utf8", "root", "");
    }

    //Obtiene y devuelve de la base de datos todas las categorias.
    public function getCategorias(){
        //Envio la consulta
        $query = $this->db->prepare("SELECT * FROM categorias");
        $query->execute();

        //$categorias es un arreglo de categorias
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    //Inserta la categoria en la base de datos
    public function agregarCategoria($categoria, $fragil){

        //Blindeo(Protego) los parametreos con VALUES(?,?) (seguridad)
        $query = $this->db->prepare("INSERT INTO categorias (categoria,fragil)VALUES(?,?)");
        $query->execute([$categoria,$fragil]);
    
        return $this->db->lastInsertId();
    }


    //Elimina una categoria de la base de datos
    public function eliminarCategoria($id){
        $query = $this->db->prepare("DELETE FROM categorias WHERE id_categoria = ?");
        $query->execute([$id]);
    }

}