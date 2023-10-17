
<?php
    
    class DataBaseHelper{

        public static function crearDbSiNoExiste($host, $username, $password, $nombreDb){
            $pdo = new PDO("mysql:host=$host", $username, $password);
            $query = "CREATE DATABASE IF NOT EXISTS $nombreDb";
            $pdo->exec($query); 
        }
    }