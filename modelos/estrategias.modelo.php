<?php
require_once "conexion.php";

Class ModeloEstrategias{
    /*====================================================
            MOSTRAR NOTIMEFCCA
    =====================================================*/

    static public function mdlCargaEstrategias($paginaActual, $pageSize, $titulo, $idEstructura) {
        require_once "../controladores/ruta.controlador.php";

        $paginaPosicion = $paginaActual * $pageSize;
        $likeMatch = "'%" . $titulo . "%'";

        try {
            $statementDocumento = Conexion::conectar()->prepare("SELECT
            doc.id as id,
            doc.titulo_doc as titulo_documento,
            doc.descripcion_doc as descrip_documento,
            doc.archivo_nombre_subido_doc as archivo,
            doc.nombre_imagen_subida as imagen_documento
            FROM documento doc
            INNER JOIN documento_programas dp ON dp.documento_id = doc.id
            INNER JOIN informacion_estructura ie ON ie.id = dp.informacion_estructura_id
            WHERE doc.pasivo = 0
            AND ie.id = $idEstructura
            AND doc.titulo_doc LIKE $likeMatch
            ORDER BY ie.id DESC;");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementDocumento->execute();
        $data = $statementDocumento->fetchAll();
        $servidor = ControladorRuta::ctrServidor();

        $liElement = [];

        for($i=0; $i < $pageSize; $i++){
            if( array_key_exists($paginaPosicion,$data) ){

                $htmlCode = '
                <li class="documento temporal">
                    <a href="' . $servidor . $data[$paginaPosicion]['archivo'] . '" target="_blank">
                        <img src="' . $servidor . $data[$paginaPosicion]['imagen_documento'] . '" alt="' . $data[$paginaPosicion]['titulo_documento'] . '">
                        <div class="contenido_documento">
                            <h2 class="limitar_tres_lineas">' . $data[$paginaPosicion]['titulo_documento'] . '</h2>
                            <p class="limitar_dos_lineas">' . $data[$paginaPosicion]['descrip_documento'] . '</p>
                        </div>
                    </a>
                </li>';

                $paginaPosicion++;
                $liElement[$i] = $htmlCode;

            }else{
                break;
            }
        }

        return json_encode($liElement);
    }

    static public function mdlTotalEstrategias($tituloMatch, $idEstructura){
        $likeMatch = "'%" . $tituloMatch . "%'";

        try {
            $statementId = Conexion::conectar()->prepare("SELECT
            doc.id as id
            FROM documento doc
            INNER JOIN documento_programas dp ON dp.documento_id = doc.id
            INNER JOIN informacion_estructura ie ON ie.id = dp.informacion_estructura_id
            WHERE doc.pasivo = 0
            AND ie.id = $idEstructura
            ORDER BY ie.id DESC;");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementId->execute();
        $result = $statementId->fetchAll();
        
        return json_encode(sizeof($result));
    }

}

?>