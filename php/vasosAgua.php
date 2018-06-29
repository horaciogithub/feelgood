<?php 
	
	include 'conection.php';
	session_start();

	$cantidad = $_POST["cantidad"];
	$email = $_SESSION["u_email"];

	// Obtén la franja horaria 
	date_default_timezone_set("Europe/London");
	// Hora formato 24h
	$horaActual = date("G:i:s");
	$fechaActual = date("Y-m-d");
	
	$fechaDeTabla = " SELECT fecha
					  FROM vasos_agua
					  WHERE email = '$email' 
					  AND id_agua = ( SELECT MAX(id_agua)
					  				  FROM vasos_agua
					  				  WHERE email = '$email')";

	$conn = mysqli_query($conexion,$fechaDeTabla);
	$fecha = mysqli_fetch_assoc($conn);
	

	if ($fecha == null) {

		$inserta = " INSERT INTO vasos_agua(email,n_vasos,hora,fecha) VALUES('$email',$cantidad,'$horaActual','$fechaActual')";
		$insert = mysqli_query($conexion,$inserta);

	}else{
		if ($fecha['fecha'] == $fechaActual) {

			$vasosBebidos = " SELECT n_vasos
							  FROM vasos_agua
							  WHERE email = '$email' 
							  AND id_agua = ( SELECT MAX(id_agua)
						  				  FROM vasos_agua
						  				  WHERE email = '$email')";

			$vasosAgua = mysqli_query($conexion,$vasosBebidos);
			$vasos = mysqli_fetch_assoc($vasosAgua);

			// Seleccionamos último id de agua de este usuario
			$id_agua = " SELECT MAX(id_agua) as id
						 FROM vasos_agua
						 WHERE email = '$email'";

			$idResult = mysqli_query($conexion,$id_agua);
			$resultado = mysqli_fetch_assoc($idResult);
			$id = $resultado['id'];


			if ($cantidad == 1) {
				
				$cantidad = $cantidad + $vasos['n_vasos'];

				$actualiza = " UPDATE vasos_agua
						   	   SET n_vasos = $cantidad, hora = '$horaActual' 
						   	   WHERE id_agua = $id";

				$update = mysqli_query($conexion,$actualiza);

			}else 
				if ($cantidad == -1 && $vasos['n_vasos'] > 0) {
					
					$cantidad = $cantidad + $vasos['n_vasos'];
					
					$actualiza = " UPDATE vasos_agua
						   	   	   SET n_vasos = $cantidad, hora = '$horaActual' 
						   	       WHERE id_agua = $id";

					$update = mysqli_query($conexion,$actualiza);
				}
		
		}else{

			$inserta = " INSERT INTO vasos_agua(email,n_vasos,hora,fecha) VALUES('$email',$cantidad,'$horaActual','$fechaActual')";
			$insert = mysqli_query($conexion,$inserta);
		}
	}
	
	

	header("Location: ../subpaginas/cliente.php");
	exit();

?>