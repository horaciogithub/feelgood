function validateForm() {

    // Validate password
	var pwd1 = document.forms["form1"]["contrasena"].value;
	
	if (pwd1.length < 6) {
		document.getElementById('alert').innerHTML="<div class='alert alert-warning'><p><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> La contraseña debe contener mas de 6 caracteres</p></div>";
		return false;
	}
		    
	var pwd2 = document.forms["form1"]["contrasena2"].value;
	
	if (pwd1 != pwd2) {
		document.getElementById('alert').innerHTML="<div class='alert alert-warning'><p><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Las contraseña no coinciden</p></div>";
		return false;
	}

	// Validate year
	var date = document.forms["form1"]["fecha_nacimiento"].value;
	var dateArray = date.split("-");
	var year = dateArray[0];
		
	if (year > 2000) {
		document.getElementById('alert').innerHTML="<div class='alert alert-warning'><p><i class='fa fa-exclamation-triangle' aria-hidden='true'></i> Debe ser mayor de edad</p></div>";
		return false;
	}
		    
}