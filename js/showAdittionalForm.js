// Formulario adicional para el cliente

function mostrarFormulario() {
	var usuarioSeleccionado = document.getElementById("tipo-usuario");
	var formularioCliente = document.getElementById("formulario-cliente");
	

	if (usuarioSeleccionado.options[usuarioSeleccionado.selectedIndex].value == "cliente") {
		formularioCliente.style.display = "block";

		if ( !document.getElementById("id")) {
                  
      var estatura = document.createElement("input");
      estatura.type = "number";
      estatura.className = "form-control latest-inputs";
      estatura.name = "estatura";
      estatura.id = "id";
      estatura.placeholder = "Estatura*";
      estatura.min = "1";
      estatura.max = "3";
      estatura.step = "any";
      estatura.required = true;
      container.appendChild(estatura);
      // Append a line break 
      container.appendChild(document.createElement("br"));

      var peso = document.createElement("input");
      peso.type = "number";
      peso.className = "form-control latest-inputs";
      peso.name = "peso";
      peso.placeholder = "Peso*";
      peso.step = "any";
      peso.min = "20";
      peso.max = "300";
      peso.required = true;
      container.appendChild(peso);
      // Append a line break 
      container.appendChild(document.createElement("br"));
                  
    }

  } else{
          formularioCliente.style.display = "none";
    }
}