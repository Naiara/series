window.onload = function(){
    //Añadir evento para comprobar que las dos contraseña coinciden
    let password = document.getElementById('password');
    let password2 = document.getElementById('confirmPassword');

    password2.addEventListener('keyup', comprobarPassword);

    document.getElementById('passwordForm').addEventListener('submit', comprobarPassword);

    function comprobarPassword(event){        
        // Obtener los valores de las contraseñas
        var newPassword = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirmPassword').value;

        // Comprobar si las contraseñas coinciden
        if (newPassword !== confirmPassword) {
            // Evitar el envío del formulario
            event.preventDefault();
            
            // Mostrar mensaje de error
            var passwordError = document.getElementById('passwordError');
            passwordError.style.display = 'block';
            
            // Marcar el campo como inválido
            document.getElementById('confirmPassword').classList.add('is-invalid');
        } else {
            // Si coinciden, quitar el mensaje de error (si existía)
            document.getElementById('confirmPassword').classList.remove('is-invalid');
            document.getElementById('passwordError').style.display = 'none';
        }
    }
}