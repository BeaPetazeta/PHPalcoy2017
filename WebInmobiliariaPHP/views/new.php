<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir</title>
</head>
<body>
<form action="/desktop/examenPHP/new.php" method="POST">
    <label for="adress">Dirección</label>
    <input type="text" name="adress" required>

    <label for="price">Precio</label>
    <input type="text" name="price">

    <label for="description">Descripción</label>
    <input type="text" name="description">

    <input type="submit" value="Dar de alta nuevo inmueble">
</form>
<br>
<br>
<footer>
	Creado por Beatriz Zarzo
</footer>
</body>
</html>