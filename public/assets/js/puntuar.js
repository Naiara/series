window.onload = function(){

    //Añadir evento a las estrellas
    let estrellas = document.querySelectorAll('.estrella');
    estrellas.forEach(estrella => {
        estrella.addEventListener('click', puntuar);
    });

    function puntuar(evento){
        //Obtener el id de la serie
        let id = evento.target.dataset.serieid;
        //Obtener la puntuación
        let puntuacion = evento.target.dataset.puntuacion;
        //Enviar la puntuación al servidor
        //index.php?controller=serie&action=index
        //fetch('index.php?controller=serie&action=puntuarSerie&id=' + id + '&puntuacion=' + puntuacion, {
        fetch('index.php?controller=serie&action=puntuarSerie', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                puntuacion: puntuacion
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.success)    {
                console.log('Puntuación actualizada');
                for(let i = 1; i <= 5; i++){
                    let estrella = document.querySelector(`#estrella${id}_${i}`);
                    console.log(estrella);
                    if(i <= puntuacion){
                        if(estrella.classList.contains('estrella_vacia'))
                            estrella.classList.remove('estrella_vacia');
                    } else {
                        estrella.classList.add('estrella_vacia');
                    }
                }
            }   
        });
    }
}