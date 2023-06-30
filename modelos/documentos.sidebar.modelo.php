<?php

require_once "conexion.php";

Class ModeloDocumentosSideBar{
    /*====================================================
            MOSTRAR LOS ULTIMOS DOCUMENTOS EN LOS SIDE BAR POR ESTRUCTURA
    =====================================================*/

    static public function mdlDocumentosSideBar($idEstructura){
        $table1 = 'documento';

        try {
            $statementDocumento = Conexion::conectar()->prepare("SELECT 
                doc.titulo_doc as titulo_documento, 
                doc.descripcion_doc as descrip_documento, 
                doc.nombre_imagen_subida as imagen_documento,
                doc.archivo_nombre_subido_doc as archivo
                FROM $table1 doc 
                WHERE doc.pasivo = 0
                AND doc.estructura_id = $idEstructura
                ORDER BY doc.id DESC LIMIT 2;");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementDocumento -> execute();
        return $statementDocumento -> fetchAll();

        $statementDocumento = null;
    }

    static public function mdlObtenerCategoriasDocumentos(){
        try {
            $statement = Conexion::conectar()->prepare("SELECT cat.descripcion as desripcion
            FROM catalogo cat
            WHERE cat.ref_tipo_catalogo = 'TDOC'
            AND cat.pasivo = 0");

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statement->execute();
        return $statement->fetchAll();
        
        $statement = null;
    }

    static public function mdlDocumentosInicio(){

        try {
            $statementDocumento = Conexion::conectar()->prepare("SELECT 
                doc.titulo_doc as titulo_documento, 
                doc.descripcion_doc as descrip_documento, 
                doc.nombre_imagen_subida as imagen_documento,
                doc.archivo_nombre_subido_doc as archivo
                FROM documento doc 
                WHERE doc.pasivo = 0
                ORDER BY doc.id DESC LIMIT 3;");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementDocumento -> execute();
        return $statementDocumento -> fetchAll();

        $statementDocumento = null;
    }

    static public function mdlTotalDocEstructura($idEstructura){
        $table1 = 'documento';

        try {
            $statementDocumento = Conexion::conectar()->prepare("SELECT
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

        $statementDocumento -> execute();
        return $statementDocumento -> fetchAll();

        $statementDocumento = null;
    }

    static public function mdlDocEstructuraSideBar($idEstructura) {
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
            ORDER BY ie.id DESC LIMIT 2;");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementDocumento->execute();
        return $statementDocumento -> fetchAll();

        $statementDocumento = null;
    }
}

?>