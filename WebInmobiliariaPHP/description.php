<?php
	require_once "config/conexion.php";

	try {
	    $stmt = $pdo->prepare('
	        SELECT * from pisos
	        WHERE id=:id
	    ');

	    $stmt->execute([
	        ':id' => $_GET['id']
	    ]);
	    $piso = $stmt->fetch();

	    $pdo = null;
	    $stmt = null;

	} catch (PDOException $e) {
	    print "¡Error!: " . $e->getMessage() ."<br/>";
	    die();
	}

	if($piso){
	    include 'views/description.php';
	}else{
	    echo 'Lo sentimos, el inmueble solicitado no se encuentra disponible';
	}
?>