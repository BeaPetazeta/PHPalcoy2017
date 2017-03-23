<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pisos</title>
	<meta name="Author" content="Beatriz Zarzo Durá" >
</head>
<body>
	<header>
		<img src="public/images/logo.jpg" alt="Logotipo Inmobiliaria" width="450px" height="175px">
	</header>
	<br>
	<form action="edit_delete_description.php" method="GET">
		<table>
			<tr>
				<th></th>
				<th>Dirección</th>
				<th>Precio</th>
			</tr>
			<?php foreach ($pisos as $piso): ?>
				<tr>
					<td>
						<input type="radio" name="id" value="<?= $piso['id'] ?>">
					</td>
					<td>
						<?= $piso["adress"] ?>
					</td>

					<td>
						<?= $piso["price"] ?>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
		<br>
		<select name="action">
			<option value="edit">Editar</option>
			<option value="delete">Eliminar</option>
			<option value="description">Más información</option>
		</select>
		<input type="submit" value="Enviar">
	</form>
	<br>
	<a href="views/new.php" value="nuevo">Nuevo inmueble</a>
	<br>
	<br>
<footer>
	Creado por Beatriz Zarzo
</footer>
</body>
</html>