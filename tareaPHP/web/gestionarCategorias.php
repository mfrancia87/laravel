<?php
session_start();
require '../includes/header.php';

require '../includes/menuNav.php';
require '../includes/operacionesBD.php';

$conexion = conectarBD();

$listaCategorias = listarCategorias($conexion);

?>


    
    <div class="col-lg-8 col-sm-8 col-xs-12">
        <h4>El sistema cuenta con las siguientes categorías</h4>
        <ul class="list-group" id="lista">
            <?php
                foreach ($listaCategorias as $categoria){
            ?>
                <li class="list-group-item"><?php echo "$categoria[1]"." (ID = ".$categoria[0].")" ?></li>            
            <?php
                    $listaHijos = encontrarHijos($conexion, $categoria[0]);
                    if($listaHijos != NULL){
                        foreach ($listaHijos as $hijo){
            ?>
                            <li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$hijo[1]"." (ID = ".$hijo[0].")" ?></li>  
            <?php   
                            $listaNietos = encontrarHijos($conexion, $hijo[0]);
                            if($listaNietos != NULL){
                                foreach ($listaNietos as $nieto){
            ?>
                                    <li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$nieto[1]"." (ID = ".$nieto[0].")" ?></li>  
            <?php
                                    $listaBisnietos = encontrarHijos($conexion, $nieto[0]);
                                    if($listaBisnietos != NULL){
                                        foreach ($listaBisnietos as $bisnieto){
            ?>
                                            <li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$bisnieto[1]"." (ID = ".$bisnieto[0].")" ?></li>  
            <?php
                                        }
                                    }
                                }
                            }
                        
                        }
                    }
                }
            ?>
        </ul>
    </div>
    
    <div style="border: 2px solid black; border-radius: 10px; padding: 10px; background-color: lavender;" class="col-lg-4 col-sm-4 col-xs-12">
        <h4>Agregar nueva categoria:</h4>
        <form method="post" action="../phpScripts/agregarCategoria.php">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="checkboxID">¿Es subcategoría?</label>
                <input id="checkboxID" name="checkboxID" type="checkbox">
            </div>
            
            <div id="idCategoria" class="form-group" hidden>
                <label for="nombre">ID de la categoría padre:</label>
                <input type="number" step="1" min="1" class="form-control" name="id">
            </div>

            <button class="btn btn-danger"><a style="text-decoration: none; color: white" href="../index.php">Cancelar</a></button>
            <button type="submit" class="btn btn-default">Agregar</button>
        </form>

    </div>



    
    <script>
        $(function(){
            
            $('.list-group-item').on('mouseover', function() {
                $(this).css("background-color","lavender");
            }).on('mouseout', function() {
                $(this).css("background-color","transparent");
            });
                     
            $('input[name="checkboxID"]').on('click', function(){
                if ($(this).is(':checked')){
                    $('#idCategoria').show();
                } 
                else{
                    $('#idCategoria :input').val('');
                    $('#idCategoria').hide();
                }
            });
        });
                 
            
      
    
    </script>