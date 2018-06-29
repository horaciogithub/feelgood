<?php 
	session_start();

	if (isset($_POST['submit'])) {

		include 'conection.php';

		$email = mysqli_real_escape_string($conexion,$_POST['validateEmail']); // mysqli_real_escape... para verificar que no se incluya info maliciosa
		$pwd = mysqli_real_escape_string($conexion,$_POST['validateContrasena']);

		// Chequea si los inputs estan vacíos
		if (empty($email) || empty($pwd)) {
			header("Location: ../index.html?login=empty");
			exit();
		}else{

			$sql = " SELECT * 
					 FROM usuario_registrado 
					 WHERE email = '$email'";

			$result = mysqli_query($conexion, $sql);
			$resultCheck = mysqli_num_rows($result);// numero filas

			if ($resultCheck < 1) {
				header("Location: ../index.html?login=error");// en el caso de que el numero de filas sea cero
				exit();
			}else{
				if ($row = mysqli_fetch_assoc($result)) {

					// Desencripta la contraseña
					$hashedPwdCheck = password_verify($pwd, $row['contrasena']);

					if ($hashedPwdCheck == false) {

						header("Location: ../index.html?login=contraseña incorrecta");
						exit();

					}elseif($hashedPwdCheck == true){

						// variables de sesion
						$_SESSION['u_email'] = $row['email']; 
						$_SESSION['u_name'] = $row['nombre']; 
						$_SESSION['u_surn'] = $row['apellidos']; 
						$_SESSION['u_date'] = $row['fecha_nacimiento']; 
						$_SESSION['u_kind'] = $row['tipo']; 

						if ($row['tipo'] == "cliente") {

							header("Location: ../subpaginas/cliente.php?login=cliente");
							exit();

						}else if ($row['tipo'] == "nutricionista") {

							header("Location: ../subpaginas/nutricionista.php?login=nutricionista");
							exit();

						}else if ($row['tipo'] == "entrenador") {

							header("Location: ../subpaginas/entrenador.php?login=entrenador");
							exit();

						}
						
					}
					
				}
			}
		}
	}else{
		header("Location: ../index.html?login=error");// En el caso de que haya un error en el login
		exit();
	}
?>
