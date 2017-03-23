<?php 
	ini_set("display_errors", 1);
	ini_set("display_startup_errors", 1);
	error_reporting(E_ALL);

	require_once("config/conexion.php");

	try {
		$stmt = $pdo->prepare ("SELECT * FROM pisos");
		$stmt->execute();
		$pisos = $stmt->fetchAll();

		include "views/index.php";

	} catch (PDOException $e){
		print "Error" . $e->getMessage() . "<br/>";
		die();
	}
?>