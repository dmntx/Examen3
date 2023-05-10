<?php

include 'conexion.php';
$pdo = new Conexion();
header("Content-Type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id']))
    {
        $sql = $pdo->prepare("SELECT * FROM alumnos WHERE id=:id");
        $sql->bindValue(':id', $_GET['id']);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 hay datos");
        echo '{"alumnos": ' . json_encode($sql->fetchAll()) . '}';
        exit;				
        
        } else {
        
        $sql = $pdo->prepare("SELECT * FROM alumnos");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 hay datos");
        echo '{"alumnos": ' . json_encode($sql->fetchAll()) . '}';
        exit;		
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "INSERT INTO `alumnos` (`id`, `nombre`, `apellidoP`, `apellidoM`, `grado`) VALUES (:id, :nombre, :apellidoP, :apellidoM, :grado)";
		$stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id']);
		$stmt->bindValue(':nombre', $_POST['nombre']);
		$stmt->bindValue(':apellidoP', $_POST['apellidoP']);
		$stmt->bindValue(':apellidoM', $_POST['apellidoM']);
        $stmt->bindValue(':grado', $_POST['grado']);

		$stmt->execute();
			header("HTTP/1.1 200 Ok");
			exit;
	}

    if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{
		$sql = "UPDATE `alumnos` SET id=:id, nombre=:nombre, apellidoP=:apellidoP, apellidoM=:apellidoM, grado=:grado WHERE id=:id";
		$stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_GET['id']);
		$stmt->bindValue(':nombre', $_GET['nombre']);
		$stmt->bindValue(':apellidoP', $_GET['apellidoP']);
		$stmt->bindValue(':apellidoM', $_GET['apellidoM']);
        $stmt->bindValue(':grado', $_GET['grado']);
		$stmt->execute();
			header("HTTP/1.1 200 Ok");
			exit;
	}

    if($_SERVER['REQUEST_METHOD'] == 'DELETE')
	{
		$data = json_decode(file_get_contents("php://input"), true);
		$id = $data["id"];
		$sql = "DELETE FROM `alumnos` WHERE id=:id";
		$stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
			header("HTTP/1.1 200 Ok");
			exit;
	}
    

?>