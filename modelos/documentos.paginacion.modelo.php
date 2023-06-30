<?php
require_once "conexion.php";

Class ModeloPaginacionDocumentos{
    /*====================================================
            MOSTRAR PAGINACION DE DOCUMENTOS
    =====================================================*/

    static public function mdlMostrarDocumentos($paginaActual,$pageSize,$titulo,$filtroEstructura) {
        require_once "../controladores/ruta.controlador.php";

        $paginaPosicion = $paginaActual * $pageSize;
        $likeMatch = "'%" . $titulo . "%'";

        $table1 = 'documento';
        $mode = 'DESC';

        try {
            $statementDocumento = Conexion::conectar()->prepare("SELECT 
                doc.titulo_doc as titulo_documento, 
                doc.descripcion_doc as descrip_documento, 
                doc.nombre_imagen_subida as imagen_documento,
                doc.archivo_nombre_subido_doc as archivo
                FROM $table1 doc 
                WHERE doc.pasivo = 0
                AND doc.titulo_doc LIKE $likeMatch
                $filtroEstructura
                ORDER BY doc.id $mode ");
                
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

    static public function mdlTotalDocumentos($tituloMatch,$filtroEstructura){
        $table1 = 'documento';
        $mode = 'DESC';
        $likeMatch = "'%" . $tituloMatch . "%'";

        try {
            $statementId = Conexion::conectar()->prepare("SELECT 
            doc.id as id
            FROM $table1 doc 
            WHERE doc.pasivo = 0
            AND doc.titulo_doc LIKE $likeMatch
            $filtroEstructura
            ORDER BY doc.id  $mode");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementId->execute();
        $result = $statementId->fetchAll();
        
        return json_encode(sizeof($result));
    }

    // Para obtener las categorias
    static public function mdlObtenerCategoriasDocumentos(){
        try {
            $statementId = Conexion::conectar()->prepare("SELECT descripcion
            FROM catalogo cat
            INNER JOIN documento doc
            ON doc.categoria_doc_id = cat.id
            AND cat.pasivo = 0");

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementId->execute();
        $result = $statementId->fetchAll();
        
        return json_encode(sizeof($result));
    }

    static public function mdlDocumentosFiltroCategoria($paginaActual, $pageSize, $filtro, $titulo, $filtroEstructura) {
        require_once "../controladores/ruta.controlador.php";

        $paginaPosicion = $paginaActual * $pageSize;
        $likeMatch = "'%" . $titulo . "%'";
        $filtroMatch = "'%" . $filtro . "%'";

        try {
            $statementDocumento = Conexion::conectar()->prepare("SELECT
            doc.titulo_doc as titulo_documento, 
            doc.descripcion_doc as descrip_documento, 
            doc.nombre_imagen_subida as imagen_documento,
            doc.archivo_nombre_subido_doc as archivo
            FROM documento doc
            INNER JOIN catalogo cat
            ON cat.id = doc.categoria_doc_id
            WHERE doc.pasivo = 0
            AND cat.descripcion LIKE $filtroMatch
            AND doc.titulo_doc LIKE $likeMatch
            $filtroEstructura
            ORDER BY doc.id DESC");
                
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

    static public function mdlTotalDocumentosFiltradosCategoria($filtro, $tituloMatch, $filtroEstructura){
        $likeMatch = "'%" . $tituloMatch . "%'";
        $filtroMatch = "'%" . $filtro . "%'";

        try {
            $statementId = Conexion::conectar()->prepare("SELECT 
            doc.id as id
            FROM documento doc
            INNER JOIN catalogo cat
            ON cat.id = doc.categoria_doc_id
            WHERE doc.pasivo = 0
            AND cat.descripcion LIKE $filtroMatch
            AND doc.titulo_doc LIKE $likeMatch
            $filtroEstructura
            ORDER BY doc.id DESC");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementId->execute();
        $result = $statementId->fetchAll();
        
        return json_encode(sizeof($result));
    }
}

?>