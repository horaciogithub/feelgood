<?php 
	
	session_start();

	include("conection.php");

	// Recoge variable email
	$email = $_SESSION['u_email'];

	// =========================================
	// 1- BORRADO DE MENSAJES EN LA TABLA HILO_FORO
	// =========================================

	// Seleciona los ids y cuenta cantidad de mensajes
	do{
		$resultado = " SELECT id_hilo ,COUNT(id_hilo) AS mensajes
					   FROM comenta 
					   WHERE email ='$email'";

		$sqlConect = mysqli_query($conexion,$resultado);

		$ids = mysqli_fetch_assoc($sqlConect);

		$id = $ids['id_hilo'];
			
		// Borra los mensajes
		$delMsg = " DELETE 
					FROM hilo_foro 
					WHERE id_hilo = $id";

		$delMensajes =  mysqli_query($conexion,$delMsg);

	}while($id);	
		
	// ==================================

	// =======================================
	// 2- BORRADO DE EMAIL EN USUARIO REGISTRADO
	// =======================================

	// elimina al usuario
	$deleteUser = " DELETE 
					FROM usuario_registrado
 					WHERE email = '$email'";

	 $query = mysqli_query($conexion,$deleteUser);
	

 	if ($query) {
 		header("Location: ../index.html");
	}else{
	 	echo "Usuario NO eliminado";
	 }

	// ==================================

?>