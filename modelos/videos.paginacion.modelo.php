<?php
require_once "conexion.php";

Class ModeloPaginacionVideos{
    /*====================================================
            MOSTRAR VIDEOS PAGINACION
    =====================================================*/

    static public function mdlMostrarVideos($paginaActual,$pageSize,$titulo,$filtroEstructura) {
        $paginaPosicion = $paginaActual * $pageSize;
        $likeMatch = "'%" . $titulo . "%'";

        try {
            $statementVideo = Conexion::conectar()->prepare(" SELECT 
                vi.titulo_video as titulo_video,
                vi.link_video as link_video
                FROM video vi
                WHERE vi.pasivo = 0
                AND vi.titulo_video LIKE $likeMatch
                $filtroEstructura
                ORDER BY vi.id DESC");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementVideo->execute();
        $data = $statementVideo->fetchAll();

        $liElements = [];

        for($i=0; $i < $pageSize; $i++){

            if( array_key_exists($paginaPosicion,$data) ){
                $videoStory = 'videostory' . ($i+1);
                $htmlCode = '
                <li class="video temporal">
                    <img class="imagen_youtube" src=""></img>
                    <div class="contenido_video">
                        <h2 class="limitar_tres_lineas">' . $data[$paginaPosicion]['titulo_video'] . '</h2>
                        <div class="opciones_video">
                            <p><i srcUrl="' . $data[$paginaPosicion]['link_video'] . '" class="far fa-clock tiempoDuracion" aria-hidden="true"></i></p>
                            <a href="#' . $videoStory . '" class="videoLink"><i class="fas fa-play" aria-hidden="true"></i></a>
                            <div id="' . $videoStory . '" class="mfp-hide" style="max-width: 75%; margin: 0 auto">
                                <div class="iframe-container">
                                    <div srcUrl="' . $data[$paginaPosicion]['link_video'] . '" class="youtubeFrame" id="player' . ($i+1) . '"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>';

                $liElements[$i] = $htmlCode;
                $paginaPosicion++;
            }else{
                break;
            }
        }

        return json_encode($liElements);
    }

    static public function mdlVideosSinFiltros($tituloMatch,$filtroEstructura){
        $likeMatch = "'%" . $tituloMatch . "%'";
        try {
            $statementId = Conexion::conectar()->prepare("SELECT
            vi.id
            FROM video vi
            WHERE vi.pasivo = 0
            AND vi.titulo_video LIKE $likeMatch
            $filtroEstructura
            ORDER BY vi.id DESC");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    
        $statementId->execute();
    
        $videos = $statementId->fetchAll();
    
        return json_encode(sizeof($videos));
    }

    static public function mdlVideosFiltroCategoria($paginaActual, $pageSize, $filtro, $titulo, $filtroEstructura) {
        $paginaPosicion = $paginaActual * $pageSize;
        $likeMatch = "'%" . $titulo . "%'";

        try {
            $statementVideo = Conexion::conectar()->prepare(" SELECT 
                vi.titulo_video as titulo_video,
                vi.link_video as link_video
                FROM video vi
                INNER JOIN catalogo cat
                ON cat.id = vi.categoria_video
                WHERE vi.pasivo = 0
                AND cat.descripcion = '$filtro'
                AND vi.titulo_video LIKE $likeMatch
                $filtroEstructura
                ORDER BY vi.id  DESC");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementVideo->execute();
        $data = $statementVideo->fetchAll();

        $liElements = [];

        for($i=0; $i < $pageSize; $i++){

            if( array_key_exists($paginaPosicion,$data) ){
                $videoStory = 'videostory' . ($i+1);
                $htmlCode = '
                <li class="video temporal">
                    <img class="imagen_youtube" src=""></img>
                    <div class="contenido_video">
                        <h2 class="limitar_tres_lineas">' . $data[$paginaPosicion]['titulo_video'] . '</h2>
                        <div class="opciones_video">
                            <p><i srcUrl="' . $data[$paginaPosicion]['link_video'] . '" class="far fa-clock tiempoDuracion" aria-hidden="true"></i></p>
                            <a href="#' . $videoStory . '" class="videoLink"><i class="fas fa-play" aria-hidden="true"></i></a>
                            <div id="' . $videoStory . '" class="mfp-hide" style="max-width: 75%; margin: 0 auto">
                                <div class="iframe-container">
                                    <div srcUrl="' . $data[$paginaPosicion]['link_video'] . '" class="youtubeFrame" id="player' . ($i+1) . '"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>';

                $liElements[$i] = $htmlCode;
                $paginaPosicion++;
            }else{
                break;
            }
        }

        return json_encode($liElements);
    }

    static public function mdlTotalVideosFiltradosCategoria($filtro, $tituloMatch, $filtroEstructura){
        $likeMatch = "'%" . $tituloMatch . "%'";

        try {
            $statementId = Conexion::conectar()->prepare("SELECT
            vi.id
            FROM video vi
            INNER JOIN catalogo cat
            ON cat.id = vi.categoria_video
            WHERE vi.pasivo = 0
            AND cat.descripcion = '$filtro'
            AND vi.titulo_video LIKE $likeMatch
            $filtroEstructura
            ORDER BY vi.id  DESC");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementId->execute();
        $result = $statementId->fetchAll();
        
        return json_encode(sizeof($result));
    }

}

?>