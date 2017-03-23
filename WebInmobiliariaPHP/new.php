<?php 
	require_once "config/conexion.php";

	if ($_POST){
		try{
			$stmt = $pdo->prepare('
				INSERT INTO pisos
				(adress, price, description)
				VALUES
				(:adress, :price, :description)
			');

			$stmt->execute([
				":adress" => $_POST["adress"],
				":price" => $_POST["price"],
				":description" => $_POST["description"],
			]);

			include "index.php";
			die();

		}catch (PDOException $e){
		print "Error" . $e->getMessage() . "<br/>";
		die();
	}
}