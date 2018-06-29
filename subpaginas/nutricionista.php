<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Feel Good</title>
	<meta charset="utf-8">
	<meta name="author" content="Horacio Ramírez">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- ––––––––––––– -->
	<!--    FAVICON    -->
	<!-- ––––––––––––– -->
	
	<link rel="icon" type="image/png" href="../img/feelgood.png">
	
	<!-- –––––––––––––––– -->
	<!--    BOOTSTRAP     -->
	<!-- –––––––––––––––– -->

	<link rel="stylesheet" type="text/css" href="../bootstrap/bootstrap.css"> 
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-- ––––––––––– -->
	<!--     CSS     -->
	<!-- ––––––––––– --> 

	<!-- Local -->
	<link rel="stylesheet" type="text/css" href="../css/styles.css"> 
	<link rel="stylesheet" type="text/css" href="../css/adminStyles.css">
	
	<!-- ––––––––––––– -->
	<!--     FONTS     -->
	<!-- ––––––––––––– -->

	<!-- Lato -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">

	<!-- Font Awesome CDN -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<!-- –––––––––––––––––– -->
	<!--     JAVASCRIPT     -->
	<!-- –––––––––––––––––– -->
	<!-- Go up button -->
	<script src="../js/goUpButton.js"></script>

	<!-- Go view nav -->
	<script src="../js/goView.js"></script>

	<!-- Delete user confirmation-->
	<script src="../js/confirmDeleteUser.js"></script>

</head>
<body>

	<!-- –––––––––––––– -->
	<!--     HEADER     -->
	<!-- –––––––––––––– -->

	<header class="container-expand">
		<div class="wrapper wrapper-img"> 
			<img src="../img/feelgood.png">
		</div>
		<div class="form-inline login" method="post">
			<?php 

				if (isset($_SESSION['u_email'])) {

					// Codifica para ver tildes y acentos
					$nombre = utf8_decode($_SESSION['u_name']);

					// Cambia mensaje bienvenida según género
					if (substr($nombre, -1) == 'a') {
						echo "<h5 style='margin-right:12px;color:#29B873'>Bienvenida <i class='fa fa-user-circle' aria-hidden='true'></i> ".$nombre."</h5>";
					}else{
						echo "<h5 style='margin-right:12px;color:#29B873'>Bienvenido <i class='fa fa-user-circle' aria-hidden='true'></i> ".$nombre."</h5>";
					}
				}else{

					header("Location:../index.html");
				}
				
			?>
			
			<!-- User options -->
			<button type="submit" name="submit" class="logout btn btn-green dropdown">
			    <a class="dropbtn">
					<i class="fa fa-caret-down" aria-hidden="true"></i>
			    </a>
			    <div class="dropdown-content">
			      <a href="../php/logout.php">Salir</a>
			      <a style="color:black" onclick="confirm()">Eliminar cuenta</a>
					
					<!-- Confirmation -->
			      	<div id="dropConfirm">
			      		<p class="text-danger">¿Estas seguro/a?</p>
					    <div style="display: flex;flex-direction: row">
					    	<a class="text-danger yes-confim" href="../php/deleteUser.php">SI</a>
					    	<a class="text-success" href="">NO</a>
					    </div>
			    	</div>
			   </div>
			</button>
		</div>
	</header>

	<!-- –––––––––––––– -->
	<!--     NAVBAR     -->
	<!-- –––––––––––––– -->

	<nav class="navbar navbar-expand-sm bg-light">

		<!-- Smartphone Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Navbar Items -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" onclick="firstContent()">Dietas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" onclick="secondContent()">Usuarios</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" onclick="thirdContent()">Comentarios</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" onclick="fourthContent()">Síguenos</a>
				</li>
			</ul>
		</div>
	</nav>

	<!-- Go up Button -->
	<button class="go-up" id="myBtn" title="Subir">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</button>

	<!-- ––––––––––––––––––––––– -->
	<!--     TIPOS DE DIETAS     -->
	<!-- ––––––––––––––––––––––– -->

	<section id="first" class="row content1">
		<div class="searchBox col-8 col-lg-3"> 
			<h4 class="searchBox-title">Buscar dietas</h4>
			<form method="post" action="nutricionista.php" class="searchBox-form">
				<select class="form-control" name="tipo_dieta" placeholder="Buscar tipos de dietas">
					<option value="hipercalorica" selected>Hipercalórica</option>
					<option value="hipocalorica">Hipocalórica</option>
				</select>
				<button class="btn btn-green searchBox-button" type="submit" style="" name="submit">Buscar</button>
			</form>
		</div>

		<div class="trainingContainer col-lg-9">
			
			<?php 

				if (isset($_POST['submit'])) {

					include '../php/conection.php';

					$tipo =  mysqli_real_escape_string($conexion,$_POST['tipo_dieta']);

					if ($tipo == 'hipercalorica' || $tipo == 'hipocalorica') {
							
						$sql = " SELECT * 
								 FROM tabla_dieta 
								 WHERE tipo_dieta = '$tipo'";

						$result = mysqli_query($conexion,$sql);
						$numFilas = mysqli_num_rows($result);
						$row = mysqli_fetch_assoc($result);

						echo "<h1>Dietas  $tipo"."s ". "</h1>";
						echo "</div>";

						echo "<div class='table-responsive trainingContainer col-lg-12'>";

						// Conecta y hace la consulta, devuelve un array 
						$resultPlatos = mysqli_query($conexion,$sql);

						echo "<table class='trainingTable'>";
						echo "<tr>";
						echo "<td class='tableHeading'>PLATO</td>";
						echo "<td class='tableHeading'>PROTEÍNAS (grs)</td>";
						echo "<td class='tableHeading'>CARBOHIDRATOS (grs)</td>";
						echo "<td class='tableHeading'>CALORÍAS (kcal)</td>";
						echo "</tr>";
						echo "<tr>";

						while ( $showTables = mysqli_fetch_array($resultPlatos)) {
									
							// Selecciona el id de la tabla
							$idTabla = $showTables[0]; 

							$consulta = " SELECT nombre_plato,cant_proteinas,cant_carbohidratos,calorias 
										  FROM platos 
										  WHERE id_dieta= $idTabla";

								

							$resultado = mysqli_query($conexion,$consulta);

							while ( $show = mysqli_fetch_array($resultado)) {

			    				// Nombre del ejercicio
								$comida = utf8_encode($show[0]);
								echo "<td>$comida</td>";

			    				// Número de series 
								echo "<td>$show[1]\n</td>";

			    				// 	Número de repeticiones
								echo "<td>$show[2]\n</td>";

			    				// Descanso 
								echo "<td>$show[3]\n</td>";

								echo "</tr>";
							}

						}
						echo "</table>";
					}else{

						echo "<h4 class ='noResult'>No hay resultados</h4>";
					}
				}
			?>
		</div>
	</section>

	<!-- ––––––––––––––– -->
	<!--    USUARIOS     -->
	<!-- ––––––––––––––– -->

	<section class="container-fluid">
		<div id="demo" class="col-lg-12 content">
			<h1>Usuarios</h1>
		</div>

		<!-- Cantidad de usuarios nuevos -->
		<div class="row">
			<?php 
				include '../php/conection.php';

				// Cantidad de usuarios nuevos sin ejercicios
				$cantidad = " SELECT COUNT(email) AS cantidad
							  FROM cliente
							  WHERE id_dieta IS NULL";

				$count = mysqli_query($conexion,$cantidad);
				$cantidad = mysqli_fetch_assoc($count);
					
				// Muestra si hay algun usuario nuevo
				if ($cantidad['cantidad'] > 0) {

					if ($cantidad['cantidad'] == 1) {

						echo "<h3 class='col-lg-6'>HAY " . $cantidad['cantidad'] . " USUARIO NUEVO";

					}else{

						echo "<h3 class='col-lg-6'>HAY " . $cantidad['cantidad'] . " USUARIOS NUEVOS";
					}

					echo "<div class='red-rectangle new-user col-3 col-lg-3'></div>";
				}
			?>
		</div>
		
		<!-- Formulario de búsqueda de usuarios -->
		<div id="demo" class="row content2">
			<div class="optionPanel col-lg-3">
				<form method="post" action="nutricionista.php" class="form-inline">
					<label class="optionPanel-label col-lg-12">
						<h4 class="complexion">PESO</h4>
					</label>

					<label class="col-6 col-lg-6">Desde</label>
					<label class="col-6 col-lg-6">Hasta</label>
					<input class="form-control col-6 col-lg-6" type="text" name="pesoMinimo" placeholder="0.000" maxlength="6">
					<input class="form-control col-6 col-lg-6" type="text" name="pesoMaximo" placeholder="240.999" maxlength="6">
					<br><br>

					<label class="optionPanel-label col-lg-12">
						<h4 class="complexion">ALTURA</h4>
					</label><br>
					<label class="col-6 col-lg-6">Desde</label>
					<label class="col-6 col-lg-6">Hasta</label>
					<input class="form-control col-6 col-lg-6" type="text" name="alturaMinima" placeholder="1.52" maxlength="4">
					<input class="form-control col-6 col-lg-6" type="text" name="alturaMaxima" placeholder="2.00" maxlength="4">
					<br><br>

					<input class="btn btn-green optionPanel-button " type="reset" name="" value="Borrar">
					<input class="btn btn-green optionPanel-btn" type="submit" name="buscarClientes" value="Buscar">
				</form>
			</div>

			<!-- Tabla de usuarios -->
			<div class="table-responsive users col-lg-9">
				<?php 
					
					if (isset($_POST['buscarClientes'])) {

						include '../php/conection.php';

						$pesoMin = mysqli_real_escape_string($conexion,$_POST['pesoMinimo']);

						$pesoMax = mysqli_real_escape_string($conexion,$_POST['pesoMaximo']);

						$alturaMin = mysqli_real_escape_string($conexion,$_POST['alturaMinima']);

						$alturaMax = mysqli_real_escape_string($conexion,$_POST['alturaMaxima']);

						if (($pesoMin == "" && $pesoMax == "") && ($alturaMin == "" && $alturaMax == "")) {

							$searchSql = " SELECT * 
										   FROM cliente";

						}else 
							if (($pesoMin != "" && $pesoMax != "") && ($alturaMin == "" && $alturaMax == "")) {

								$searchSql = " SELECT * 
											   FROM cliente 
											   WHERE peso BETWEEN $pesoMin AND $pesoMax";

							}else 
								if (($pesoMin == "" && $pesoMax == "") && ($alturaMin != "" && $alturaMax != "")) {

									$searchSql = " SELECT * 
											   	   FROM cliente 
											       WHERE  estatura BETWEEN $alturaMin AND $alturaMax";

								}else{

									$searchSql = " SELECT * 
											       FROM cliente 
											       WHERE peso BETWEEN $pesoMin AND $pesoMax 
											       AND estatura BETWEEN $alturaMin AND $alturaMax";
								}

						$UserAmount = mysqli_query($conexion,$searchSql);
						$row = mysqli_fetch_assoc($UserAmount);
						$search = mysqli_query($conexion,$searchSql);

						if ($row > 0) {

							echo "<table class='table usersTable'";
							echo "<tr>";
							echo "<td class='usersFields'>EMAIL</td>";
							echo "<td class='usersFields'>SEXO</td>";
							echo "<td class='usersFields'>EDAD</td>";
							echo "<td class='usersFields'>ALTURA</td>";
							echo "<td class='usersFields'>PESO</td>";
							echo "<td class='usersFields'>IMC</td>";
							echo "<td class='usersFields'>VALOR</td>";
							echo "</tr>";

							echo "<tr>";

							while ($showClients = mysqli_fetch_array($search)) {
									
								// Muestra si hay usuarios sin ejercicios 
								if ($showClients[6] == null) {

									echo "<td class=' new-user usersFields'>$showClients[0]</td>";

								}else{

									echo "<td class='usersFields'>$showClients[0]</td>";
								}
									
								echo "<td class='usersFields'>$showClients[1]</td>";
								echo "<td class='usersFields'>$showClients[2]</td>";
								echo "<td class='usersFields'>$showClients[3]</td>";
								echo "<td class='usersFields'>$showClients[4]</td>";

								// Calcula el IMC a través del peso
								$imc = $showClients[4] / pow($showClients[3],2);

								// Formato para el resultado
								$resultado = number_format($imc,2,'.',',');
									
								echo "<td class='usersFields'>$resultado</td>";

								// Asigna un estado al resultado del IMC
								if ($resultado < 18.50 ) {
									echo "<td class='usersFields'>Infrapeso</td>";
								}else
									if($resultado < 24.99 && $resultado > 18.50){
										echo "<td class='usersFields'>Peso normal</td>";
									}else
										if($resultado > 25.00){
										echo "<td class='usersFields'>Sobrepeso</td>";
										}

								echo "</tr>";

								}
								
								echo "</table>";

						}else{
								echo "<h4 class = 'noResult'>No hay resultados</h4>";
						}
					}
				?>
			</div>
	</section>	
		
	<?php 
		
		include "../php/conection.php";	
		
		$email = " SELECT email 
				   FROM cliente
				   WHERE id_dieta IS NULL";

		$correo = mysqli_query($conexion,$email);

		// Número de filas del resultado
		$numeroFilas = mysqli_num_rows($correo);

		// Muestra formulario si hay usuarios nuevos
		if ($numeroFilas > 0) {
					
			// Muestra select con las opciones de email disponibles
			echo "<section class='set-form'>";
			echo "<form class='set col-md-4' action='../php/asignarDietas.php' method='post'>";
			echo "<select name='usuario' class='form-control col-md-12'>";
							
			while ( $cantidad = mysqli_fetch_array($correo)) {
						
				echo  "<option value='$cantidad[0]''>$cantidad[0]</option>" ;
			}

			echo "</select><br/>";

			echo "<select name='dieta' class='form-control col-md-12'>";
			echo "<option value='1'>Hipocalórica</option>";
			echo "<option value='2'>Hipercalórica</option>";
			echo "</select>";

			echo "<input class='set-first-btn set-button btn btn-green' type='reset' value='Borrar'>";
			echo "<input class='set-button btn btn-green' type='submit' value='Enviar'>";
			echo "</form>";
			echo "</section>";
			}
					
	?> 
		
	<section id="third" class="containder-fluid">
			
		<div class="comments">
			<h1>DEJA TU COMENTARIO AQUÍ <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></h1>
			<hr class="first-hr" />

			<?php 

				include '../php/conection.php';

				$coments = " SELECT autor_hilo,asunto,id_hilo 
							 FROM hilo_foro";

				$result = mysqli_query($conexion,$coments);

				while ($show = mysqli_fetch_array($result)) {

					$autor = utf8_decode($show[0]);
					$mensaje = utf8_encode($show[1]);

					echo "<div class='col-sm-2 author'>";
					echo "<p><b>$autor</b></p>";
					echo "</div>";

					// variable sesion
					$email = $_SESSION['u_email'];
						 
					// Selecciona los  mensajes escritos por este autor con ese email
					$mensajeAutor = " SELECT h.asunto, h.id_hilo 
									  FROM hilo_foro h , comenta c 
									  WHERE h.id_hilo = c.id_hilo
									  AND c.email= '$email';";

					$mensajequery = mysqli_query($conexion,$mensajeAutor);

					while($rowMensajes = mysqli_fetch_array($mensajequery)){
						 	

						 // Muestra si el mensaje ha sido escrito por ese autor
						 // Pueden tener el mismo nombre pero no ser la misma persona
						if ($mensaje == $rowMensajes[0]) {

							echo "<form action='../php/borrarMensaje.php' method='post'>";

							// Borra el mensaje con éste id
							echo "<input type='hidden' value='$show[2]' name='borra'>";
							echo "<input class='delete btn btn-danger' type='submit' value='x' title='Eliminar mensaje'>";
							echo "</form>";
							
						}
					}

					echo "<p class='col-sm-12 message'>$mensaje</p>";
					echo "<hr>";
				}
			?>

			<!-- Formulario para comentar -->
			<form action="../php/inserComments.php" method="post">
					
				<div class="col-sm-12">
					<textarea class="form-control" name="message" placeholder="Mensaje....." rows="4" required></textarea><br>
				</div>
					
				<input class="btn btn-green reset"  type="reset" name="" value="Cancelar">
				<input class="btn btn-green"  type="submit" name="" value="Enviar">
			</form>
		</div>
	</section>
	
	<footer id="fourth" class="text-center">
        <div class="social">
            <a href="https://twitter.com/?lang=es" title="Síguenos en Twitter!" target="_blank">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
        </div>
        <div class="social">
            <a href="https://es-es.facebook.com/" title="Síguenos en Facebook!" target="_blank">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
        </div>
        <div class="social">
            <a href="https://www.instagram.com/?hl=es" title="Síguenos en Instagram!" target="_blank">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        </div>
        <div class="copyrigth">
            <p><i class="fa fa-copyright" aria-hidden="true"></i>2018 FeelGood - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>