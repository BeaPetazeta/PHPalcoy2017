<?php 
	include "config/conexion.php";

	$stmt = $pdo->prepare("
	DELETE FROM pisos
	WHERE id=:id
	");

	$stmt->execute([':id'=>$_GET['id']]);
	include "index.php";
	die();
?>