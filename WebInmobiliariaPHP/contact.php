<?php 
	require_once "config/conexion.php";

	if ($_POST){
		try{
			$stmt = $pdo->prepare('
				INSERT INTO contacto
				(name, surname, email, phone)
				VALUES
				(:name, :surname, :email, :phone)
			');
			$stmt->execute([
				":name" => $_POST["name"],
				":surname" => $_POST["surname"],
				":email" => $_POST["email"],
				":phone" => $_POST["phone"],
			]);

			include "received.php";
			die();

		}catch (PDOException $e){
		print "Error" . $e->getMessage() . "<br/>";
		die();
	}
}