<?php
class ProductoModel{
    //Atributo
    private $db;

    //Constructor
    function __construct(){
        $this->db = new PDO("mysql:host=localhost;dbname=db_tpe;charset=utf8", "root", "");
    }

    //Obtiene y devuelve de la base de datos todos los productos de una determinada categoria.
    public function getProductosXCategoria($id_fk){
        // Envío la consulta para obtener los productos de una categoría específica
        $query = $this->db->prepare("SELECT * FROM productos WHERE id_categoria = ?");
        $query->execute([$id_fk]);
    
        // $productos es un arreglo de productos
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $productos;
    }
    

}