<?php

require_once "conexion.php";

class ModeloRadio {
    /*==========================================
    Mostrar Programas de Radio
    ==========================================*/
    static public function mdlMostrarRadio($tabla, $item, $valor) {
        if($item != null && $valor != null) {

            $stmt = Conexion::conectar() -> prepare("SELECT id,
            tema,
            fecha_programa AS fecha,
            link_programa AS link
            FROM $tabla
            WHERE pasivo = false
            AND $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar() -> prepare("SELECT id,
            tema,
            fecha_programa AS fecha,
            link_programa AS link
            FROM $tabla
            WHERE pasivo = false
            ORDER BY id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;
    }

    /*==========================================
    Obtener el consecutivo del proximo programa de radio
    ==========================================*/
    static public function mdlRegistroConsecutivo() {

        $stmt = Conexion::conectar()->prepare(
            "SELECT
                CASE 
                    WHEN MAX(id) IS NULL THEN 1
                    ELSE MAX(id)+1
                END AS id
            FROM programa_radio"
        );

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*==========================================
    Registro Programa de Radio
    ==========================================*/
    static public function mdlRegistroRadio($tabla, $datos) {
        
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(tema, link_programa, fecha_programa, creado_por, creado_en_ip)
            VALUES(:tema, :link, :fecha, :creado_por, :creado_en_ip)"
        );
        
        $stmt->bindParam(':tema', $datos["tema"], PDO::PARAM_STR);
        $stmt->bindParam(':link', $datos["link"], PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(':creado_por', $datos["creado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':creado_en_ip', $datos["creado_en_ip"], PDO::PARAM_STR);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;

    }

    /*==========================================
    Editar Programa de Radio
    ==========================================*/
    static public function mdlEditarRadio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET tema = :tema, link_programa = :link, fecha_programa = :fecha, modificado_el = :modificado_el,
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':tema', $datos["tema"], PDO::PARAM_STR);
        $stmt->bindParam(':link', $datos["link"], PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $datos["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;

    }

    /*==========================================
    Eliminar Programa de Radio
    ==========================================*/
    static public function mdlEliminarRadio($tabla, $datos){

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true, modificado_el = :modificado_el,
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $datos["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;

    }

}