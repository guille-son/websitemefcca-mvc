<?php
require_once "conexion.php";

Class ModeloNotimefcca{
    /*====================================================
            MOSTRAR NOTIMEFCCA
    =====================================================*/

    static public function mdlCargaNoticias($paginaActual,$pageSize,$titulo) {
        require_once "../controladores/ruta.controlador.php";

        $paginaPosicion = $paginaActual * $pageSize;
        $table1 = 'noticia';
        $table3 = 'usuario';
        $mode = 'DESC';
        $pasivo = 0;
        $servidor = ControladorRuta::ctrServidor();
        $likeMatch = "'%" . $titulo . "%'";

        try {
            $statementNoticia = Conexion::conectar()->prepare(" SELECT
                noti.id as id,
                noti.titulo_noticia as titulo_noticia,
                noti.descrip_noticia_corta as descrip_noticia_corta,
                noti.imagen as imagen_noticia,
                CONCAT_WS(' ', usr.nombres, usr.apellidos) AS nombre_completo,
                DATE(noti.creado_el) as fecha,
                TIME(noti.creado_el) as hora,
                noti.link_twitter AS twitter,
                noti.link_facebook AS facebook,
                noti.link_instagram AS instagram
                FROM $table1 noti
                INNER JOIN $table3 usr
                    ON noti.creado_por = usr.id
                WHERE noti.pasivo = 0
                AND noti.titulo_noticia LIKE $likeMatch
                ORDER BY noti.id $mode ");
                
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $statementNoticia->execute();
        $noticias = $statementNoticia->fetchAll();

        $liElements = [];

        for($i=0; $i < $pageSize; $i++){
            if( array_key_exists($paginaPosicion,$noticias) ){

                $direccion = ModeloNotimefcca::mdlGetDireccionHref($noticias[$paginaPosicion]['titulo_noticia'],$noticias[$paginaPosicion]['id']);
                
                $tipo = "noticia-";
                $pleca = "/";
                $url = ControladorUrlAmigable::ctrUrlAmigable($noticias[$paginaPosicion]['titulo_noticia']);
                $face = "https://www.facebook.com/share.php?u=";
                $twi = "https://twitter.com/share?url=";
                $wha = "https://web.whatsapp.com/send?text=";
                $mefcca = "https://www.economiafamiliar.gob.ni/websitemefcca-mvc/";


                $htmlCode = '
                <li class="noticia temporal">
                    <img src="' . $servidor . $noticias[$paginaPosicion]['imagen_noticia'] . '" alt="Imagen Noticia">
                    <div class="contenido_noticia">
                        <div class="encabezado_noticia">
                            <h2 class="limitar_tres_lineas">' . $noticias[$paginaPosicion]['titulo_noticia'] . '</h2>
                            <div class="lista_detalle_noticia">
                                <p><i class="far fa-calendar" aria-hidden="true"></i> <span>' . $noticias[$paginaPosicion]['fecha'] . '</span></p>
                                <p><i class="far fa-clock" aria-hidden="true"></i> <span>' . $noticias[$paginaPosicion]['hora'] . '</span></p>
                                <p><i class="far fa-user" aria-hidden="true"></i> <span>' . $noticias[$paginaPosicion]['nombre_completo'] . '</p>
                            </div>
                        </div>
                        <p class="limitar_dos_lineas">' . $noticias[$paginaPosicion]['descrip_noticia_corta'] . '</p>
                        <div class="pie_noticia">
                            <nav class="redes_sociales">
                                <a href="' . $face . $mefcca . $tipo . $url . $pleca . $noticias[$paginaPosicion]['id'] . '" target="_blank" class="facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                <a href="' . $wha . $mefcca . $tipo . $url . $pleca . $noticias[$paginaPosicion]['id'] . '" target="_blank" class="whatsapp"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                <a href="' . $twi . $mefcca . $tipo . $url . $pleca . $noticias[$paginaPosicion]['id'] . '" target="_blank" class="twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            </nav>
                            <a href="' . $direccion . '" class="boton btn_estilo_dos">Ver más <i
                                    class="fas fa-arrow-right icono_arrow icono_boton"></i></a>
                        </div>
                    </div>
                </li>';

                $paginaPosicion++;
                $liElements[$i] = $htmlCode;
            }else{
                break;
            }
        }

        return json_encode($liElements);
    }

    /* Carga de solo los ID para la gestion de la paginacion */
    static public function mdlNumNoticias($tituloMatch){
        $likeMatch = "'%" . $tituloMatch . "%'";

        try {
            $statementId = Conexion::conectar()->prepare("SELECT noti.id
            FROM noticia noti
            WHERE noti.pasivo = 0
            AND noti.titulo_noticia LIKE $likeMatch
            ORDER BY noti.id DESC");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    
        $statementId->execute();
    
        $noticiasId = $statementId->fetchAll();
    
        return json_encode(sizeof($noticiasId));
    }

    static public function mdlGetDireccionHref($tituloNoticia,$idNoticia){
        require_once "../controladores/ruta.controlador.php";
        require_once "../controladores/urlamigable.controlador.php";

        $ruta = ControladorRuta::ctrRuta();
        $url = ControladorUrlAmigable::ctrUrlAmigable($tituloNoticia);
        $noticia = "noticia-";
        $pleca = "/";
        $id = $idNoticia;
        
        $direccion = $ruta.$noticia.$url.$pleca.$id;

        return $direccion;
    }
}

?>