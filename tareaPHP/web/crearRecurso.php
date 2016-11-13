<?php
session_start();

//si no está logueado o si no es proveedor
if(!isset($_SESSION["idUsuario"]) || $_SESSION["esProveedor"]!=1){
    header("Location: ../index.php");
}


require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();
$listaCat = encontrarCategoriasHojas($conexion);
?>


<div class="panel panel-info">
  <div class="panel-heading">Nuevo recurso</div>
  <div class="panel-body">
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
    
    <?php
    if(!empty($listaCat)){
    ?>
    <div class="checkbox">
        <legend style="font-family: rockwell; font-size: 15px; font-weight: bold;">Elija la/s categoría/s</legend>
    <?php
        foreach ($listaCat as $categoria) {
    ?>
    
        <label style="float: left; display: inline-block; padding-right: 4px;"><input name="categoria[]" type="checkbox" value="<?php echo $categoria[0] ?>"><?php echo $categoria[1];?></label>
    
    <?php 
        }
    ?>
    </div>
    <?php
    }
    ?>
    
    <br><br><br>
    
    <div class="form-group">
        <label for="plan" >Disponible para plan:</label>
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
  </div>
</div>
      
<?php
require '../includes/footer.php';