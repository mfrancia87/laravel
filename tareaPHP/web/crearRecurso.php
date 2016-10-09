<?php
session_start();
require '../includes/header.php';

require '../includes/menuNav.php';

?>

<form method="post" action="../phpScripts/crearRecurso.php" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="nick">Nombre:</label>
        <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="tipoRecurso">Tipo de recurso:</label>
        <select class="form-control" name="tipoRecurso">
            <option value="articulo">Artículo</option>
            <option value="revista">Revista</option>
            <option value="libro">Libro</option>
            <option value="video">Video</option>
        </select>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" rows="5" name="descripcion" required></textarea>
    </div>
    <div class="form-group">
        <label for="plan">Disponible para plan:</label>
        <select class="form-control" name="plan">
            <option value="free">Free</option>
            <option value="silver">Silver</option>
            <option value="gold">Gold</option>
        </select>
    </div>
    <div class="checkbox">
        <label><input name="esDescargable" type="checkbox" value="si">Es descargable</label>
    </div>
    <div id="imagen" class="form-group">
        <label for="imagen">Vista previa (imagen)</label>
        <input type="file" class="form-control" name="imagen">
    </div>
    <div class="form-group">
        <label for="archivo">Selecciona el archivo</label>
        <input type="file" class="form-control" name="archivo">
    </div>
    
    <button type="submit" class="btn btn-success">Dar de alta el recurso</button>
</form>

