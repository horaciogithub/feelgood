<?php 
	session_start();
	include 'conection.php';

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––
	//     RECIBIR LOS DATOS Y ALMACENARLOS EN VARIUABLES
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––

	$email = $_SESSION["email"];
	$sexo = $_POST["sexo"];
	$edad = $_POST["edad"];
	$estatura = $_POST["estatura"];
	$peso = $_POST["peso"];
	

	// –––––––––––––––––––––––––––––––
	//     CONSULTA PARA INSERTAR
	// –––––––––––––––––––––––––––––––

	$insert = "INSERT INTO cliente(email,sexo,edad,estatura,peso) VALUES('$email','$sexo','$edad','$estatura','$peso')";
	$result =  mysqli_query($conexion,$insert);

	// ––––––––––––––––––––––––––	
	//     EJECUTAR CONSULTA
	// ––––––––––––––––––––––––––

	header("Location: ../subpaginas/cliente.php");
	
	// ––––––––––––––––––––––––
	//     CERRAR CONEXION
	// ––––––––––––––––––––––––

	mysqli_close($conexion);
	
?>