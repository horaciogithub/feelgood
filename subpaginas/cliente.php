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
	<link rel="stylesheet" type="text/css" href="../css/customerStyles.css">
	
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

					// Decodifica para ver tildes y acentos
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
			      <a onclick="confirm()">Eliminar cuenta</a>
					
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
					<a class="nav-link" onclick="firstContent()">Tu entrenamiento</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" onclick="secondContent()">Tu dieta</a>
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

	
		<button class="go-up" id="myBtn" title="Subir">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</button>
		<section id="table-container">
			
			<?php 

				if (isset($_SESSION['u_email'])) {

					include '../php/conection.php';

					$email = $_SESSION['u_email'];

					$search = " SELECT * 
								FROM tabla_ejercicio 
								WHERE id_tabla = ( SELECT id_tabla 
												   FROM cliente 
												   WHERE email = '$email')";

					$result = mysqli_query($conexion,$search);
					$show = mysqli_fetch_array($result);

					// Muestra tabla si hay ejercicios
					if (sizeof($show) > 0) {

						echo "<div id='first' class='col-lg-12 content'>";
						echo "<h1>TUS EJERCICIOS PARA ESTA SEMANA</h1>";
						echo "<hr class='underline'>";
						echo "</div>";

						echo "<div class='table-responsive'>";
						echo "<table class='table trainingTable'>";
						echo"<tr>";
						echo "<td colspan='2'>Fecha inicio: </td>";
						echo "<td colspan='2'>$show[3]</td>";
						echo"</tr>";
						echo"<tr>";
						echo "<td colspan='2'>Fecha fin: </td>";
						echo "<td colspan='2'>$show[4]</td>";
						echo"</tr>";

						// –––––––––
						//   LUNES
						// –––––––––
						echo "<tr>";
						echo "<td colspan='4' class='week'>LUNES</td>";
						echo "</tr>";

						$id = $show[0];

						$excercises = " SELECT * 
										FROM ejercicio 
										WHERE id_tabla = '$id'";

						$consult = mysqli_query($conexion,$excercises);

						echo "<tr class='info'>";
						echo "<td>EJERCICIO</td>";
						echo "<td>Nº SERIES</td>";
						echo "<td>Nº REPETICIONES</td>";
						echo "<td>DESCANSO</td>";
						echo "</tr>";
							
						while ( $showExercises = mysqli_fetch_array($consult)) {
								
							echo "<tr>";
								
							// Muestra las palabras con tildes y acentos
							$ejercicios = utf8_encode($showExercises[2]);
							echo "<td>$ejercicios</td>";
							echo "<td>$showExercises[3]</td>";
							echo "<td>$showExercises[4]</td>";
							echo "<td>$showExercises[5]</td>";
							echo "</tr>";
						}

						// ––––––––––
						//   MARTES
						// ––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>MARTES</td>";
						echo "</tr>";

						$id = $show[0];

						$excercises = " SELECT * 
										FROM ejercicio 
										WHERE id_tabla = '$id'";

						$consult = mysqli_query($conexion,$excercises);

						echo "<tr class='info'>";
						echo "<td>EJERCICIO</td>";
						echo "<td>Nº SERIES</td>";
						echo "<td>Nº REPETICIONES</td>";
						echo "<td>DESCANSO</td>";
						echo "</tr>";
							
						while ( $showExercises = mysqli_fetch_array($consult)) {
								
							echo "<tr>";
								
							// Muestra las palabras con tildes y acentos
							$ejercicios = utf8_encode($showExercises[2]);
							echo "<td>$ejercicios</td>";
							echo "<td>$showExercises[3]</td>";
							echo "<td>$showExercises[4]</td>";
							echo "<td>$showExercises[5]</td>";
							echo "</tr>";
						}

						// –––––––––––––
						//   MIÉRCOLES
						// –––––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>MIÉRCOLES</td>";
						echo "</tr>";

						$id = $show[0];

						$excercises = " SELECT * 
										FROM ejercicio 
										WHERE id_tabla = '$id'";

						$consult = mysqli_query($conexion,$excercises);

						echo "<tr class='info'>";
						echo "<td>EJERCICIO</td>";
						echo "<td>Nº SERIES</td>";
						echo "<td>Nº REPETICIONES</td>";
						echo "<td>DESCANSO</td>";
						echo "</tr>";
							
						while ( $showExercises = mysqli_fetch_array($consult)) {
								
							echo "<tr>";

							// Muestra las palabras con tildes y acentos
							$ejercicios = utf8_encode($showExercises[2]);
							echo "<td>$ejercicios</td>";
							echo "<td>$showExercises[3]</td>";
							echo "<td>$showExercises[4]</td>";
							echo "<td>$showExercises[5]</td>";
							echo "</tr>";
						}

						// ––––––––––
						//   JUEVES
						// ––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>JUEVES</td>";
						echo "</tr>";

						$id = $show[0];

						$excercises = " SELECT * 
										FROM ejercicio 
										WHERE id_tabla = '$id'";

						$consult = mysqli_query($conexion,$excercises);

						echo "<tr class='info'>";
						echo "<td>EJERCICIO</td>";
						echo "<td>Nº SERIES</td>";
						echo "<td>Nº REPETICIONES</td>";
						echo "<td>DESCANSO</td>";
						echo "</tr>";
							
						while ( $showExercises = mysqli_fetch_array($consult)) {
								
							echo "<tr>";
								
							// Muestra las palabras con tildes y acentos
							$ejercicios = utf8_encode($showExercises[2]);
							echo "<td>$ejercicios</td>";
							echo "<td>$showExercises[3]</td>";
							echo "<td>$showExercises[4]</td>";
							echo "<td>$showExercises[5]</td>";
							echo "</tr>";
						}

						// –––––––––––
						//   VIERNES
						// –––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>VIERNES</td>";
						echo "</tr>";

						$id = $show[0];

						$excercises = " SELECT * 
										FROM ejercicio 
										WHERE id_tabla = '$id'";

						$consult = mysqli_query($conexion,$excercises);

						echo "<tr class='info'>";
						echo "<td>EJERCICIO</td>";
						echo "<td>Nº SERIES</td>";
						echo "<td>Nº REPETICIONES</td>";
						echo "<td>DESCANSO</td>";
						echo "</tr>";
							
						while ( $showExercises = mysqli_fetch_array($consult)) {
								
							echo "<tr>";
								
							// Muestra las palabras con tildes y acentos
							$ejercicios = utf8_encode($showExercises[2]);
							echo "<td>$ejercicios</td>";
							echo "<td>$showExercises[3]</td>";
							echo "<td>$showExercises[4]</td>";
							echo "<td>$showExercises[5]</td>";
							echo "</tr>";
						}

						echo"</table>";

					}
						
				}
			?>
				
		</section>
		<section id="table-container">
			
			<?php 

				if (isset($_SESSION['u_email'])) {

					include '../php/conection.php';

					$email = $_SESSION['u_email'];

					$search = " SELECT * 
								FROM tabla_dieta 
								WHERE id_dieta = ( SELECT id_dieta 
												   FROM cliente 
												   WHERE email = '$email')";

					$result = mysqli_query($conexion,$search);
					$show = mysqli_fetch_array($result);

					// Muestra dietas si hay ejercicios
					if (sizeof($show) > 0) {

						echo "<div id='demo' class='col-lg-12 content'>";
						echo "<h1>HEMOS PREPARADO ESTA DIETA PARA TI</h1>";
						echo "<hr class='underline'>";
						echo "</div>";
						echo "<div class='table-responsive'>";

						echo "<table class='table trainingTable'>";
						echo"<tr>";
						echo "<td colspan='2'>Fecha inicio: </td>";
						echo "<td colspan='2'>$show[3]</td>";
						echo"</tr>";
						echo"<tr>";
						echo "<td colspan='2'>Fecha fin: </td>";
						echo "<td colspan='2'>$show[4]</td>";
						echo"</tr>";

						$id = $show[0];

						$dieta = " SELECT * 
						    	   FROM platos 
						       	   WHERE id_dieta = '$id'";

						$consult = mysqli_query($conexion,$dieta);

						// –––––––––
						//   LUNES
						// –––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>LUNES</td>";
						echo "</tr>";

						echo "<tr class='info'>";
						echo "<td>PLATO</td>";
						echo "<td>PROTEÍNAS</td>";
						echo "<td>CARBOHIDRATOS</td>";
						echo "<td>CALORÍAS</td>";
						echo "</tr>";
						
						while ( $showDieta = mysqli_fetch_array($consult)) {
							
							echo "<tr>";
							$comida = utf8_encode($showDieta[2]);
							echo "<td>$comida</td>";
							echo "<td>$showDieta[3]</td>";
							echo "<td>$showDieta[4]</td>";
							echo "<td>$showDieta[5]</td>";
							echo "</tr>";
						}

						$dieta = " SELECT * 
						    	   FROM platos 
						       	   WHERE id_dieta = '$id'";

						$consult = mysqli_query($conexion,$dieta);

						// ––––––––––
						//   MARTES
						// ––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>MARTES</td>";
						echo "</tr>";

						echo "<tr class='info'>";
						echo "<td>PLATO</td>";
						echo "<td>PROTEÍNAS</td>";
						echo "<td>CARBOHIDRATOS</td>";
						echo "<td>CALORÍAS</td>";
						echo "</tr>";
						
						while ( $showDieta = mysqli_fetch_array($consult)) {
							
							echo "<tr>";
							$comida = utf8_encode($showDieta[2]);
							echo "<td>$comida</td>";
							echo "<td>$showDieta[3]</td>";
							echo "<td>$showDieta[4]</td>";
							echo "<td>$showDieta[5]</td>";
							echo "</tr>";
						}

						$dieta = " SELECT * 
						    	   FROM platos 
						       	   WHERE id_dieta = '$id'";

						$consult = mysqli_query($conexion,$dieta);

						// –––––––––––––
						//   MIÉRCOLES
						// –––––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>MIÉRCOLES</td>";
						echo "</tr>";

						echo "<tr class='info'>";
						echo "<td>PLATO</td>";
						echo "<td>PROTEÍNAS</td>";
						echo "<td>CARBOHIDRATOS</td>";
						echo "<td>CALORÍAS</td>";
						echo "</tr>";
						
						while ( $showDieta = mysqli_fetch_array($consult)) {
							
							echo "<tr>";
							$comida = utf8_encode($showDieta[2]);
							echo "<td>$comida</td>";
							echo "<td>$showDieta[3]</td>";
							echo "<td>$showDieta[4]</td>";
							echo "<td>$showDieta[5]</td>";
							echo "</tr>";
						}

						$dieta = " SELECT * 
						    	   FROM platos 
						       	   WHERE id_dieta = '$id'";

						$consult = mysqli_query($conexion,$dieta);

						// ––––––––––
						//   JUEVES
						// ––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>JUEVES</td>";
						echo "</tr>";

						echo "<tr class='info'>";
						echo "<td>PLATO</td>";
						echo "<td>PROTEÍNAS</td>";
						echo "<td>CARBOHIDRATOS</td>";
						echo "<td>CALORÍAS</td>";
						echo "</tr>";
						
						while ( $showDieta = mysqli_fetch_array($consult)) {
							
							echo "<tr>";
							$comida = utf8_encode($showDieta[2]);
							echo "<td>$comida</td>";
							echo "<td>$showDieta[3]</td>";
							echo "<td>$showDieta[4]</td>";
							echo "<td>$showDieta[5]</td>";
							echo "</tr>";
						}

						$dieta = " SELECT * 
						    	   FROM platos 
						       	   WHERE id_dieta = '$id'";

						$consult = mysqli_query($conexion,$dieta);

						// –––––––––––
						//   VIERNES
						// –––––––––––
						echo "<tr>";
						echo "<td colspan='4'  class='week'>VIERNES</td>";
						echo "</tr>";

						echo "<tr class='info'>";
						echo "<td>PLATO</td>";
						echo "<td>PROTEÍNAS</td>";
						echo "<td>CARBOHIDRATOS</td>";
						echo "<td>CALORÍAS</td>";
						echo "</tr>";
						
						while ( $showDieta = mysqli_fetch_array($consult)) {
							
							echo "<tr>";
							$comida = utf8_encode($showDieta[2]);
							echo "<td>$comida</td>";
							echo "<td>$showDieta[3]</td>";
							echo "<td>$showDieta[4]</td>";
							echo "<td>$showDieta[5]</td>";
							echo "</tr>";
						}
						
						echo"</table>";

					}
						
				}
			?>
			
		</section>

		<!-- ––––––––––––––––––––– -->
    	<!--     CANTIDAD AGUA     -->
    	<!-- ––––––––––––––––––––– -->

		<section id="water" class="container-fluid water">
			<div class="row">

				<div class="col-lg-12">
					<h2>¿Cuántos vasos de agua has tomado?</h2>
					<hr class="water-line">
				</div>

				<div class="col-lg-4" style="margin: auto 0px auto 0px">
					<?php 
						include '../php/conection.php';

						$email = $_SESSION['u_email'];

						$selectVasos = " SELECT n_vasos,hora
										 FROM vasos_agua
										 WHERE email = '$email'
										 AND id_agua = ( SELECT MAX(id_agua)
						  				  FROM vasos_agua
						  				  WHERE email = '$email')";

						$conecta = mysqli_query($conexion, $selectVasos);

						$cantidad = mysqli_fetch_assoc($conecta);

						if ($cantidad > 0) {
							if ($cantidad['n_vasos'] == 0) {
								
								echo "<p class='p-center'>Has tomado 0ml</p>";
								
								echo "<div class='progress'";

								echo "<div class='progress' style='height:12px'>";
	    						echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:0%;height:12px'></div>";
	  							echo "</div>";
	  									
							}else

								if ($cantidad['n_vasos'] == 1) {
									echo "<p class='p-center'>Has tomado 250ml</p>";
							
									echo "<div class='progress'";

									echo "<div class='progress' style='height:12px'>";
    									echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:12.5%;height:12px'></div>";
  									echo "</div>";
  									
								}else{

									if ($cantidad['n_vasos'] == 2) {
										echo "<p class='p-center'>Has tomado 500ml</p>";
							
										echo "<div class='progress'";

										echo "<div class='progress' style='height:12px'>";
    										echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:25%'></div>";
  										echo "</div>";

									}else{

										if ($cantidad['n_vasos'] == 3) {
											echo "<p class='p-center'>Has tomado 750ml</p>";
							
											echo "<div class='progress'";

											echo "<div class='progress' style='height:12px'>";
    											echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:37.5%'></div>";
  											echo "</div>";

										}else{

											if ($cantidad['n_vasos'] == 4) {
												echo "<p class='p-center'>Has tomado 1000ml</p>";
							
												echo "<div class='progress'";

												echo "<div class='progress' style='height:12px'>";
    												echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:50%'></div>";
  												echo "</div>";
											}else

												if ($cantidad['n_vasos'] == 5) {
													echo "<p class='p-center'>Has tomado 1250ml</p>";
							
													echo "<div class='progress'";

													echo "<div class='progress' style='height:12px'>";
	    												echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:62.5%'></div>";
	  												echo "</div>";
												}else

													if ($cantidad['n_vasos'] == 6) {
														echo "<p class='p-center'>Has tomado 1500ml</p>";
							
														echo "<div class='progress'";

														echo "<div class='progress' style='height:12px'>";
		    												echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:75%'></div>";
		  												echo "</div>";
													}else

														if ($cantidad['n_vasos'] == 7) {
															echo "<p class='p-center'>Has tomado 1750ml</p>";
							
															echo "<div class='progress'";

															echo "<div class='progress' style='height:12px'>";
			    												echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:87.5%'></div>";
			  												echo "</div>";
														}else

															if ($cantidad['n_vasos'] >= 8) {
																echo "<p class='p-center'>2 litros ! Objetivo cumplido <span class='text-primary'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i></span</p>";
							
																echo "<div class='progress'";

																echo "<div class='progress' style='height:12px'>";
				    												echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:100%'>100%</div>";
				  												echo "</div>";

															}
										}
									}
								}
							
							echo "<div";
							echo "<br/><br/>";
							echo "<p class='p-center'>El último vaso a sido a las <span class='text-info'>".$cantidad['hora']."</span></p>";
						}else{
							
							echo "<p class='p-center'>Has tomado 0ml</p>";
							echo "<div class='progress'";
							echo "<div class='progress' style='height:12px'>";
	    					echo "<div class='progress-bar progress-bar-striped progress-bar-animated' style='width:0%;height:12px'></div>";
	  						echo "</div>";
						}
						
					?>
				</div>
				<div class="col-lg-2 " style="margin: auto 0px auto 0px ">
					
					<div class="vasos col-8 col-md-12">
						<form class="water-form" action="../php/vasosAgua.php" method="post">
							<div>
								<img src="../img/glass.png" width="50%">
								<button class="btn btn-success" type="submit" value="1" name="cantidad">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>
							
							<div>
								<img src="../img/glass.png" width="50%">
								<button class="btn btn-danger" type="submit" value="-1" name="cantidad">
									<i class="fa fa-minus" aria-hidden="true"></i>
								</button>
							</div>
						</form>
					</div>

				</div>

				<div class="col-lg-4">
					<img class="beber-agua" src="../img/beberAgua.png" width="50%">
				</div>
			</div>
		</section>

		<!-- ––––––––––––––––––– -->
    	<!--     COMENTARIOS     -->
    	<!-- ––––––––––––––––––– -->

		<section id="third">
			
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

						echo "<div class='col-sm-3 author'>";
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
						};

						echo "<p class='col-sm-12 message'>$mensaje</p>";
						echo "<hr>";
					}
				?>
				<form action="../php/inserComments.php" method="post">
					
					<div class="col-sm-12">
						<textarea class="form-control" name="message" placeholder="Mensaje....." rows="4" required></textarea><br>
					</div>
					<input class="btn btn-green reset"  type="reset" name="" value="Cancelar">
					<input class="btn btn-green"  type="submit" name="" value="Enviar">
				</form>
			</div>
		</section>
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