
    <h1>Añadir serie</h1>
    
    private $id;
    private $titulo;
    private $descripcion;
    private $puntuacion_media;
    <form action="/series/add" method="post">
        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Add Series">
    </form>
</body>
</html>