<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle</title>
</head>
<body>

<p>
    <a href="index.php">Catálogo de inmuebles</a>
    - Volver a inicio
</p>

<h1>Inmueble situado en: <?=$piso['adress']?></h1> 
<h2>Precio de Venta: <?=$piso['price']?></h2>
<p><?=$piso['description']?></p>

<p>
    <a href="edit.php?id=<?=$piso['id']?>">
        Editar
    </a>
</p>
<form action="contact.php" method="post" >
	<table>
		<thead>
			<tr>
				<th colspan="2" ><h3>Para más información, introduzca sus datos y nos pondremos en contacto con usted:</h3></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Nombre:</td>
				<td><input type="text" name="name" placeholder="Su nombre" ></td>
			</tr>
			<tr>
				<td>Apellidos:</td>
				<td><input type="text" name="surname" placeholder="Sus apellidos" ></td>
			</tr>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" placeholder="Correo electrónico" ></td>
			</tr>
			<tr>
				<td>Teléfono:</td>
				<td><input type="text" name="phone" placeholder="Teléfono de contacto" ></td>
			</tr>
			<tr>
				<td colspan="2" >
					<input type="submit" name="Enviar">
					<input type="reset" name="Borrar">
				</td>
			</tr>
		</tbody>
	</table>
</form>
<br>
<br>
<footer>
	Creado por Beatriz Zarzo
</footer>
</body>
</html>