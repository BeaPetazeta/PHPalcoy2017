<?php 
	require_once "config/conexion.php";
	if(isset($_POST["adress"])){
		try{
			$stmt = $pdo->prepare("
				UPDATE pisos SET
				adress=:adress,
				price=:price,
				description=:description
				WHERE id=:id
			");
			$stmt->execute([
				":id"=> $_POST["id"],
				":adress"=> $_POST["adress"],
				":price"=> $_POST["price"],
				":description"=> $_POST["description"],
			]);
			include "index.php";
			die();

		}catch (PDOException $e){
			print "Error" . $e->getMessage() . "<br/>";
			die();
		}
	}else{
		try{
			$stmt = $pdo->prepare("
				SELECT * FROM pisos
				WHERE id=:id
			");

			$stmt->execute([
				":id" => $_GET["id"]
			]);

			$piso = $stmt->fetch();
		}catch (PDOException $e){
			print "Error" . $e->getMessage() . "<br/>";
			die();
		}
	}include "views/edit.php";
?>