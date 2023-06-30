<?php

require_once "conexion.php";

Class ModeloDocumentosInicio{

    static public function mdlMostrarDocumentosInicio($txtBusqueda) {

        require_once "../controladores/ruta.controlador.php";

        $servidor = ControladorRuta::ctrServidor();
        $likeMatch = "'%" . $txtBusqueda . "%'";

        $stmt = Conexion::conectar()->prepare("SELECT doc.id,
            doc.titulo_doc AS titulo,
            doc.descripcion_doc AS descripcion,
            doc.archivo_nombre_subido_doc AS archivo,
            doc.nombre_imagen_subida AS imagen
            FROM documento doc
            INNER JOIN usuario usu ON doc.creado_por = usu.id
            WHERE doc.pasivo=0
            AND (doc.titulo_doc LIKE $likeMatch OR doc.descripcion_doc LIKE $likeMatch)
            ORDER BY doc.id
            DESC LIMIT 3"
        );

        $stmt->execute();

        $resultado = $stmt->fetchAll();

        $i = 0;

        $liElements = [];

        foreach ($resultado as $key => $valueDocumento) :

           $htmlCode = '<li class="documento temporal">
                    <a href="' . $servidor.$valueDocumento['archivo'] . '" target="_blank">
                        <img src="' . $servidor.$valueDocumento['imagen'] . '" alt="Imagen del Documento">
                        <div class="contenido_documento">
                            <h2 class="limitar_tres_lineas">' . $valueDocumento['titulo'] . '</h2>
                            <p class="limitar_tres_lineas">' . $valueDocumento['descripcion'] . '</p>
                        </div>
                    </a>
                </li>';
 
            $liElements[$i++] = $htmlCode;

        endforeach;

        return json_encode($liElements);
    }

    static public function mdlTotalId(){
        return json_encode([1]);
    }
}

?>