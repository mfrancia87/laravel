<?php
session_start();
require '../includes/header.php';

require '../includes/menuNav.php';
?>


<div class="panel panel-danger">
  <div class="panel-heading">Error en búsqueda:</div>
  <div class="panel-body">
      <h2>No se encontraron resultados para su búsqueda</h2>
      <h3>Redirigiendo a inicio...</h3>
  </div>
</div>

<script>
$(function(){
    var delay = 4000; //milisegundos
    var pagina = "../index.php";
    setTimeout(function(){ 
        window.location = pagina; 
    }, delay);
});
</script>

<?php
require '../includes/footer.php';