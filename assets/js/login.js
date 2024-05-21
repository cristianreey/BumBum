// Manejamos la visibilidad de la contraseña y el campo confirmar contraseña
function togglePasswordVisibility(inputId) {
  var passwordInput = document.getElementById(inputId);

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passwordInput.nextElementSibling.querySelector("i").classList.remove("fa-eye");
    passwordInput.nextElementSibling.querySelector("i").classList.add("fa-eye-slash");
  } else {
    passwordInput.type = "password";
    passwordInput.nextElementSibling.querySelector("i").classList.remove("fa-eye-slash");
    passwordInput.nextElementSibling.querySelector("i").classList.add("fa-eye");
  }
}

// Manejamos que el usuario sea mayor de edad al registrarse
function verificarEdad() {
  // Obtenemos la fecha de nacimiento introducida por el usuario
  var fechaNacimiento = document.getElementById("fechaNacimiento").value;

  // Obtenemos la fecha actual
  var hoy = new Date();

  // Calculamos la edad
  var fechaNac = new Date(fechaNacimiento);
  var edad = hoy.getFullYear() - fechaNac.getFullYear();
  var m = hoy.getMonth() - fechaNac.getMonth();

  if (m < 0 || (m === 0 && hoy.getDate() < fechaNac.getDate())) {
    edad--;
  }

  // Mostramos la alerta para los menores de 18
  if (edad < 18) {
    Swal.fire({
      icon: "error",
      title: "¡Oops!",
      text: "Debes ser mayor de 18 años para registrarte.",
      confirmButtonColor: "black",
      confirmButtonText: "Entendido",
    });
    return false; // Devolvemos false si el usuario es menor de 18 años
  }

  return true; // Devolvemos true si el usuario es mayor de 18 años
}

function verificarContraseña() {
  var contrasena = document.getElementById("contrasena").value;

  var ConfirmarContrasena = document.getElementById("confirmar_contrasena").value;

  if (contrasena != ConfirmarContrasena) {
    Swal.fire({
      icon: "error",
      title: "¡Oops!",
      text: "Por favor, confirma la contraseña correctamente.",
      confirmButtonColor: "black",
      confirmButtonText: "Entendido",
    });
    return false;
  }
  return true;
}

// Función para validar el formato del número de teléfono
function validarTelefono() {
  var telefonoInput = document.getElementById("telefono").value;
  // Expresión regular para validar el formato del número de teléfono
  var telefonoRegex = /^[0-9]{7,15}$/;

  if (!telefonoRegex.test(telefonoInput)) {
    // Alerta con SweetAlert2 si el formato del teléfono es incorrecto
    Swal.fire({
      icon: "error",
      title: "¡Oops!",
      text: "Por favor, introduce un número de teléfono válido.",
      confirmButtonColor: "black",
      confirmButtonText: "Entendido",
    });
    return false; // Devuelve false si el formato del teléfono es incorrecto
  }

  return true; // Devuelve true si el formato del teléfono es correcto
}

// Agrega un event listener al formulario para llamar a las funciones de verificación antes de enviar el formulario
document.querySelector(".registro-form").addEventListener("submit", function (event) {
  // Verificar edad y formato de teléfono antes de enviar el formulario
  if (!verificarEdad() || !validarTelefono() || !verificarContraseña()) {
    // Prevenir el envío del formulario si la verificación falla
    event.preventDefault();
  }
});
