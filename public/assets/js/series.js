window.onload = function(){
    //Añadir evento edición de serie
    let botonEliminar = document.querySelectorAll('.eliminar_serie');
    botonEliminar.forEach(boton => {
        boton.addEventListener('click', eliminarSerie);
    });

    /**
     * Eliminar serie de la base de datos
     * @param {evento} evento que lanza la función 
     */
    function eliminarSerie(evento){
        if(confirm('¿Estás seguro de que quieres eliminar la serie?')){
            //Obtener el id de la serie
            let id = evento.target.dataset.id;
            //console.log('ID: ' + id);
            //console.log(id);
            //Enviar la orden al servidor
            fetch('index.php?controller=serie&action=delete', {
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
                    console.log('Serie eliminada');
                    //evento.target.parentElement.parentElement.remove();
                    document.getElementById('serie_' + id).remove();
                }   
            });
        }
    }


}