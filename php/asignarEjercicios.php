<?php 
	session_start();
	include 'conection.php';

	// Recoge los valores

	$email = $_POST['usuario'];
	$tipo = $_POST['entrenamiento'];
	
	// ACTUALIZA LA TABLA CLIENTE MODIFICANDO EL VALOR NULL POR UN VALOR
	$insertar = " UPDATE cliente
				  SET id_tabla = $tipo
				  WHERE email = '$email'";

	$insert = mysqli_query($conexion,$insertar);

	// REGRESA A LA PÁGINA
	header("Location:../subpaginas/entrenador.php");

	mysqli_close($conexion);
?>