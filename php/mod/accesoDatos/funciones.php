<?php
require_once '../mod/clases/Comentario.php';
class funciones {

    public static function mostrarComentarios($comentarios) {
        if (is_array($comentarios) || is_object($comentarios)) {
            echo "<h2 class'espacioTop'>".sizeof($comentarios)." comentarios</h2>";
            foreach($comentarios as $comentario) {
                echo '
                <div class="row col-xs-12 col-sm-12 col-md-12  comentarios">
                
                <div class="col-xs-12 col-sm-12 col-md-2"><img src="../../imagenes/imgMaquetacion/avartar.png" alt="" class="imagenComentario"></div>
                
    
                <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="">' . $comentario->getAutor(). '</div>
                <p>'. $comentario->getContenido().'</p>
                </div>
    
                <div class="col-xs-12 col-sm-12 col-md-2">
                        <div class="">'. $comentario->getFecha_publicacion().'</div>
                    </div>
            </div>
                ';
            }
    
        }
    }


}

?>