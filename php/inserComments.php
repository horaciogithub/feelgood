<?php
	session_start();
	include 'conection.php';

	// Recoge el nombre y el apellido variable de sesiones
	$nombre = $_SESSION['u_name'];
	$apellidos = $_SESSION['u_surn'];
	$author = "$nombre" . " $apellidos";
	 
	$email = $_SESSION['u_email']; //Recoge el email
	$message = htmlentities($_POST["message"]);// Recoge el mensaje del input codificado en utf-8.
	
	// Inserta comentarios en hilo_foro	
	$insertHilo="INSERT INTO hilo_foro(autor_hilo,asunto) VALUES('$author','$message')";
	$resultHilo = mysqli_query($conexion,$insertHilo);

	// Selecciona el id del mensaje actual
	$sql = " SELECT MAX(id_hilo) as ultimoID
		     FROM hilo_foro";

	$result = mysqli_query($conexion,$sql);
	$row = mysqli_fetch_assoc($result);
	$id = $row['ultimoID'];
	
	// Inserta el email en la tabla comenta para saber el autor	
	$insertComenta="INSERT INTO comenta(email,id_hilo) VALUES('$email',$id)";
	$resultCometa = mysqli_query($conexion,$insertComenta);


	if ($_SESSION['u_kind'] =='cliente') {
		header("Location: ../subpaginas/cliente.php");
	}

	if ($_SESSION['u_kind'] =='nutricionista') {
		header("Location: ../subpaginas/nutricionista.php");
	}

	if ($_SESSION['u_kind'] =='entrenador') {
		header("Location: ../subpaginas/entrenador.php");
	}

	

	// ––––––––––––––––––––––––
	//     CERRAR CONEXION
	// ––––––––––––––––––––––––

	mysqli_close($conexion);
	
?>