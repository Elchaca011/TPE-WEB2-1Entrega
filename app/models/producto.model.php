<?php
//Incluyo el config.php el cual se encarga de la conexion a la db
require_once("config.php");
class ProductoModel{
    //Atributo
    private $db;

    //Constructor
    function __construct(){
        $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_Charset , DB_USER , DB_PASS);
    }

    //Metodos

    //Obtiene y devuelve de la base de datos todos los productos
    public function getProductos(){
        //Envía la consulta SQL con JOIN para obtener todos los productos con la información de la categoría a la que pertenece
        $query = $this->db->prepare("SELECT p.*, c.categoria AS nombre_categoria
                                    FROM productos AS p
                                    JOIN categorias AS c ON p.id_categoria = c.id_categoria");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;
    }

    //Obtiene y devuelve de la base de datos todos los productos de una determinada categoria.
    public function getProductosXCategoria($id_fk){
        // Envío la consulta para obtener los productos de una categoría específica
        $query = $this->db->prepare("SELECT * FROM productos WHERE id_categoria = ?");
        $query->execute([$id_fk]);
    
        // $productosXCategoria es un arreglo de productos por una determinada categoria
        $productosXCategoria = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $productosXCategoria;
    }

    public function agregarProducto($id_categoria,$nombre,$material,$precio){
        //Blindeo(Protego) los parametreos con VALUES(?,?,?,?) (seguridad)
        $query = $this->db->prepare("INSERT INTO productos (id_categoria,nombre,material,precio)VALUES(?,?,?,?)");
        $query->execute([$id_categoria,$nombre,$material,$precio]);

        return $this->db->lastInsertId();
    }
    

}