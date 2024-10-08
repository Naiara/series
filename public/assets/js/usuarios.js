window.onload = function(){

    //Añadir evento edición de usuario
    let botonEliminar = document.querySelectorAll('.eliminar_usuario');
    botonEliminar.forEach(boton => {
        boton.addEventListener('click', eliminarUsuario);
    });
    let botonEditar = document.querySelectorAll('.editar_usuario');
    botonEditar.forEach(boton => {
        boton.addEventListener('click', editarUsuario);
    });

    /**
     * Eliminar usuario de la base de datos
     * @param {evento} evento que lanza la función 
     */
    function eliminarUsuario(evento){
        if(confirm('¿Estás seguro de que quieres eliminar tu cuenta?')){
            //Obtener el id de la serie
            let id = evento.target.dataset.usuarioid;
            console.log('ID: ' + id);
            //console.log(id);
            //Enviar la orden al servidor
            fetch('index.php?controller=usuario&action=borrar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta');
                console.log(data);
                if(data.success)    {
                    console.log('Usuario eliminado');
                    //evento.target.parentElement.parentElement.remove();
                    document.getElementById('usuario_' + id).remove();
                }   
            });
        }
    }


    function editarUsuario(evento){

    }
}