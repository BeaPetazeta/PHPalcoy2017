<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar</title>
</head>
<body>

<p>
    <a href="index.php">Catálogo de Inmuebles</a>
    - Editar información del inmueble
</p>

<form method="POST">
    <input type="hidden" name="id" value="<?=$piso['id'] ?>">

    <label for="adress">Dirección</label>
    <input type="text" name="adress" required value="<?=$piso['adress'] ?>">

    <label for="price">Precio</label>
    <input type="text" name="price" value="<?=$piso['price'] ?>">

    <label for="description">Descripción</label>
    <input type="text" name="description" value="<?= $piso['description'] ?>">

    <input type="submit" value="Editar informacion">
</form>
<br>
<br>
<footer>
    Creado por Beatriz Zarzo
</footer>
</body>
</html>