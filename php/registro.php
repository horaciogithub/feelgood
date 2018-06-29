<?php
	session_start();
	include 'conection.php';

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––
	//     RECIBIR LOS DATOS Y ALMACENARLOS EN VARIUABLES
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––

	$email = $_POST["email"];
	$contrasena = $_POST["contrasena"];

		// Encripta la contraseña
	$contEncript = password_hash($contrasena, PASSWORD_DEFAULT);

		// Codifica a español el valor de nombre
	$nombre = utf8_encode($_POST["nombre"]);
	$apellidos = utf8_encode($_POST["apellidos"]);
	$fecha_nacimiento = $_POST["fecha_nacimiento"];
	$tipo = $_POST["tipo"];

	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
	//     CONSULTA PARA INSERTAR LOS DATOS DEL USUARIO REGISTRADO
	// ––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––

	$insert = "INSERT INTO usuario_registrado(email,contrasena,nombre,apellidos,fecha_nacimiento,tipo) VALUES('$email','$contEncript','$nombre','$apellidos','$fecha_nacimiento','$tipo')";

	$resultado = mysqli_query($conexion,$insert);

	$sql = " SELECT * 
			 FROM usuario_registrado 
			 WHERE email = '$email'";

	$result = mysqli_query($conexion, $sql);

	$row = mysqli_fetch_assoc($result);

	// Variables de sesión
	$_SESSION['u_email'] = $row['email']; // variable de sesion
	$_SESSION['u_name'] = $row['nombre']; 
	$_SESSION['u_surn'] = $row['apellidos']; 
	$_SESSION['u_date'] = $row['fecha_nacimiento']; 
	$_SESSION['u_kind'] = $row['tipo']; 

	if (!$resultado) {
		
		if ($email == $row['email']) {

			echo'Ya existe este email';

		}else{

			echo'Error de registro'.$row['email'];

		}

	}else{

			if ($tipo == 'cliente') {
				
				$sexo = $_POST["sexo"];
				$estatura = $_POST["estatura"];
				$peso = $_POST["peso"];

				// Desglosa la fecha de nacimiento
				$anyoNacimiento = date("Y",strtotime($fecha_nacimiento));
				$mesNacimiento = date("m",strtotime($fecha_nacimiento));
				$diaNacimiento = date("d",strtotime($fecha_nacimiento));

				// Obtiene año mes y día actuales
				$anyoActual = date("Y");
				$mesActual = date("m");
				$diaActual = date("d");
				
				// Calcula la edad
				$edad = $anyoActual - $anyoNacimiento;

				if ($mesNacimiento > $mesActual) {

					$edad--;

				}else 

					if(($mesNacimiento == $mesActual) & ($diaNacimiento < $diaActual)){
							$edad--;
					}

				// –––––––––––––––––––––––––––––––––
				//     INSERTA EN TABLA CLIENTE
				// –––––––––––––––––––––––––––––––––

				$insert = "INSERT INTO cliente(email,sexo,edad,estatura,peso) VALUES('$email','$sexo','$edad','$estatura','$peso')";

				$result =  mysqli_query($conexion,$insert);

				// Inicia sesión tras resgistro
				header("Location: ../subpaginas/cliente.php?login=cliente");

			}else{

					if ($tipo == 'entrenador') {
					
						// ––––––––––––––––––––––––––––––––––
						//     SELECCIONA EL SIGUIENTE ID
						// ––––––––––––––––––––––––––––––––––

						$lastID= " SELECT MAX(id_entrenador) AS id
								   FROM entrenador";

						$query =  mysqli_query($conexion,$lastID);
						$idResult = mysqli_fetch_assoc($query);

						// Id nuevo usuario suma 1
						$id = $idResult['id']+1;

						// –––––––––––––––––––––––––––––––––––––––
						//     INSERTA EN TABLA ENTRENADOR
						// –––––––––––––––––––––––––––––––––––––––

						$insert = "INSERT INTO entrenador VALUES('$id', '$email')";

						$result =  mysqli_query($conexion,$insert);
						// header("Location: ../index.html");

						header("Location: ../subpaginas/entrenador.php?login=entrenador");
					
					}else{

							if ($tipo == 'nutricionista') {
						
								// ––––––––––––––––––––––––––––––––––
								//     SELECCIONA EL SIGUIENTE ID
								// ––––––––––––––––––––––––––––––––––

								$lastID= " SELECT MAX(id_nutricionista) AS id
										   FROM nutricionista";

								$query =  mysqli_query($conexion,$lastID);
								$idResult = mysqli_fetch_assoc($query);

								// Id nuevo usuario suma 1
								$id = $idResult['id']+1;

								// –––––––––––––––––––––––––––––––––––––––
								//     INSERTA EN TABLA NUTRICIONISTA
								// –––––––––––––––––––––––––––––––––––––––

								$insert = "INSERT INTO nutricionista VALUES('$id', '$email')";

								$result =  mysqli_query($conexion,$insert);
								
								header("Location: ../subpaginas/nutricionista.php?login=nutricionista");

							}else{
				
								header("Location: ../index.html");
							}

						}

				}
			
			// ––––––––––––––––––––––––
			//     CERRAR CONEXION
			// ––––––––––––––––––––––––

			mysqli_close($conexion);
		}
?>
	