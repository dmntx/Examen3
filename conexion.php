<?php

class Conexion extends PDO{

    private $host = "localhost";
    private $usuario = "root";
	private $clave = "";
	private $bd="examen3";

    public function __construct(){
        try{
            parent::__construct('mysql:host=' . $this->host . ';dbname=' . $this->bd . ';charset=utf8', $this->usuario, $this->clave, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
				exit;
        }
    }

}

?>