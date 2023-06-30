<?php

require_once "conexion.php";

Class ModeloVideosInicio{
    /*====================================================
            MOSTRAR LOS ULTIMOS VIDEOS EN EL INICIO
    =====================================================*/

    static public function mdlMostrarVideosInicio() {
        try {
            $statementVideo = Conexion::conectar()->prepare("SELECT
            vi.id,
            vi.titulo_video,
            vi.link_video
            FROM video vi
            WHERE vi.pasivo = 0
            ORDER BY vi.id DESC LIMIT 3;");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementVideo -> execute();
        return $statementVideo -> fetchAll();

        $statementVideo = null;
    }

    static public function mdlVideosSideBar($idEstructura){
        try {
            $statementVideo = Conexion::conectar()->prepare("SELECT
            vi.id,
            vi.titulo_video,
            vi.link_video
            FROM video vi
            INNER JOIN informacion_estructura ie
            ON vi.estructura_id = ie.id
            WHERE vi.pasivo = 0
            AND ie.pasivo = 0
            AND vi.estructura_id = $idEstructura
            ORDER BY vi.id DESC LIMIT 2;");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementVideo -> execute();
        return $statementVideo -> fetchAll();

        $statementVideo = null;
    }

    static public function mdlObtenerCategoriasVideos(){
        try {
            $statement = Conexion::conectar()->prepare("SELECT
            cat.descripcion as desripcion
            FROM catalogo cat
            WHERE cat.ref_tipo_catalogo = 'CTGV'
            AND cat.pasivo = 0");

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statement->execute();
        return $statement->fetchAll();
        
        $statement = null;
    }
}

?>