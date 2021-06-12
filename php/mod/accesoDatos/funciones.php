<?php
require_once '../mod/clases/Comentario.php';
class funciones {

    public static function mostrarComentarios($comentarios) {
        if (is_array($comentarios) || is_object($comentarios)) {
            echo "<h2 class='espacio'>".sizeof($comentarios)." comentarios</h2>";
            foreach($comentarios as $comentario) {
                echo '
                <div class="row col-xs-12 col-sm-12 col-md-12 comentarios centrado">
                <div class="col-xs-4 col-sm-2 col-md-2 izquierda">
                <img src="../../imagenes/imgMaquetacion/avartar.png" alt="" class="imagenComentario">
                </div>
                <div class="col-xs-6 col-sm-8 col-md-8  sinPad">
                <div class="izquierda negrita"><h3>' . $comentario->getAutor(). '</h3></div>
                <p class="izquierda">'. $comentario->getContenido().'</p>
                 </div>
                <div class="col-xs-2 col-sm-2 col-md-2">
                        <div class="izquierda"><small><i>Posteado el '. $comentario->getFecha_publicacion().'</i></small></div>
                    </div>
            </div> ';
            }
    
        }
    }


}

?>