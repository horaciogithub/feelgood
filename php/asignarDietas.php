<?php 
	session_start();
	include 'conection.php';

	// Recoge los valores

	$email = $_POST['usuario'];
	$tipo = $_POST['dieta'];
	
	// ACTUALIZA LA TABLA CLIENTE MODIFICANDO EL VALOR NULL POR UN VALOR
	$insertar = " UPDATE cliente
				  SET id_dieta= $tipo
				  WHERE email = '$email'";

	$insert = mysqli_query($conexion,$insertar);

	// REGRESA A LA PÁGINA
	header("Location:../subpaginas/nutricionista.php");

	mysqli_close($conexion);
?>