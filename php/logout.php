<?php 
	session_start();
	session_unset();
	session_destroy();
	header("Location: ../index.html"); // cierra sesion y vuelve a index
	exit();
?>