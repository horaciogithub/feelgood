<?php
	session_start();
	include 'conection.php';

	// Recoge la variable de sesión del fichero emisor
	$id = $_POST['borra'];
	
	
	$erase = "DELETE FROM hilo_foro WHERE id_hilo = '$id'";
	$result = mysqli_query($conexion,$erase);

	// Resetea el id del hilo
	$reset = " ALTER TABLE hilo_foro  AUTO_INCREMENT = 1";
	$reseted = mysqli_query($conexion,$reset);

	$erase2 = "DELETE FROM comenta WHERE id_hilo = '$id'";
	$result2 = mysqli_query($conexion,$erase2);

	// Comprueba mediante la variable de sesión qué tipo de emisor es
	if ($_SESSION['u_kind'] =='cliente') {
		header("Location: ../subpaginas/cliente.php");
	}

	if ($_SESSION['u_kind'] =='nutricionista') {
		header("Location: ../subpaginas/nutricionista.php");
	}
	
	if ($_SESSION['u_kind'] =='entrenador') {
		header("Location: ../subpaginas/entrenador.php");
	}


?>