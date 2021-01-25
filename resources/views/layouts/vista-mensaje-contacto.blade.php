<!DOCTYPE html>
<html>
<head>
	<title>Contacto Mail</title>
</head>
<body>

	<h2> Contacto </h2>

	<br>

	<p><strong>Nombre : </strong> {{ $datos->nombre }}</p>
	<p><strong>Email : </strong> {{ $datos->email }}</p>
	<p><strong>Ciudad : </strong> {{ $datos->ciudad }}</p>
	<p><strong>Pais : </strong> {{ $datos->pais }}</p>
	<p><strong>Mensaje : </strong> {{ $datos->mensaje }}</p>

</body>
</html>