<?php 
	session_start();

	include "conection.php";

	$email = $_SESSION['u_email'];
	
	// Busca tipo de administrador

	$search = " SELECT tipo 
			    FROM usuario_registrado 
			    WHERE email = '$email'";
    
    $query = mysqli_query($conexion,$search);

    $tipo = mysqli_fetch_assoc($query);

    // ENTRENADOR

    if ($tipo['tipo'] == 'entrenador') {

    	// Selecciona su id
    	 $id = " SELECT id_entrenador 
    			FROM entrenador 
    	 		WHERE email = '$email'";
    	 $queryID = mysqli_query($conexion,$id);

    	 $id_entrenador = mysqli_fetch_assoc($queryID);
    	 $identificador = $id_entrenador['id_entrenador'];


    	// Deja a null el campo id_entrenador en tabla ejercicio
     	$update = " UPDATE tabla_ejercicio 
     				SET id_entrenador = null
		 			WHERE id_entrenador = $identificador;";

		 $updateTable = mysqli_query($conexion,$update);

    	// Elimina todo de este entrenador

    // =============================================
	// 1- BORRADO DE MENSAJES EN LA TABLA HILO_FORO
	// =============================================

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


		$deleteAdmin = " DELETE 
    				     FROM usuario_registrado 
    				     WHERE email = '$email'";

    	$delete = mysqli_query($conexion,$deleteAdmin); 

    	if ($delete) {
    		header("Location: ../index.html");
    	}else{
    		echo "Usuario NO eliminado";
    	}

    // NUTRICIONISTA
    }else{
    // Selecciona su id
    	 $id = " SELECT id_nutricionista 
    			FROM nutricionista 
    	 		WHERE email = '$email'";
    	 $queryID = mysqli_query($conexion,$id);

    	 $id_nutricionista = mysqli_fetch_assoc($queryID);
    	 $identificador = $id_nutricionista['id_nutricionista'];


    	// Deja a null el campo id_nutricionista en tabla dieta
     	$update = " UPDATE tabla_dieta 
     				SET id_nutricionista = null
		 			WHERE id_nutricionista = $identificador;";

		 $updateTable = mysqli_query($conexion,$update);

    	// Elimina todo de este nutricionista

    // =============================================
	// 1- BORRADO DE MENSAJES EN LA TABLA HILO_FORO
	// =============================================

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

		$deleteAdmin = " DELETE 
    				     FROM usuario_registrado 
    				     WHERE email = '$email'";

    	$delete = mysqli_query($conexion,$deleteAdmin); 

    	if ($delete) {
    		header("Location: ../index.html");
    	}else{
    		echo "Usuario NO eliminado";
    	}
    }
?>