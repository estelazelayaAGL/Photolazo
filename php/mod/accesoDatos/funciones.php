<?php
require_once '../mod/clases/Comentario.php';
class funciones {

    public static function mostrarComentarios($comentarios) {
        if (is_array($comentarios) || is_object($comentarios)) {
            echo "<h2 class='espacio'>".sizeof($comentarios)." comentarios</h2>";
            foreach($comentarios as $comentario) {
                echo '
                <div class="row col-xs-12 col-sm-12 col-md-8 comentarios centrado">
                
                <div class="col-xs-12 col-sm-12 col-md-2 izquierda"><img src="../../imagenes/imgMaquetacion/avartar.png" alt="" class="imagenComentario"></div>
                
    
                <div class="col-xs-12 col-sm-12 col-md-8  sinPad">
                <div class="izquierda negrita">' . $comentario->getAutor(). '</div>
                <p class="izquierda">'. $comentario->getContenido().'</p>
                 </div>
    
                <div class="col-xs-12 col-sm-12 col-md-2">
                        <div class="izquierda">'. $comentario->getFecha_publicacion().'</div>
                    </div>
            </div>
                ';
            }
    
        }
    }


}

?>