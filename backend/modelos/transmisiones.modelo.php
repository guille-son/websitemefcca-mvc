<?php

require_once "conexion.php";

class ModeloTransmisiones {
    /*==========================================
    Mostrar Transmisiones
    ==========================================*/
    static public function mdlMostrarTransmisiones($tabla, $item, $valor) {

        if($item != null && $valor != null) {

            $stmt = Conexion::conectar() -> prepare("SELECT id,
            titulo,
            hora_finalizacion AS hora,
            link_transmision AS link,
            estado
            FROM $tabla
            WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar() -> prepare("SELECT id,
            titulo,
            hora_finalizacion AS hora,
            link_transmision AS link,
            estado
            FROM $tabla
            WHERE pasivo = false
            ORDER BY id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;
    }

    /*==========================================
    Registro de Transmisión
    ==========================================*/
    static public function mdlRegistroTransmision($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(titulo, link_transmision, hora_finalizacion, creado_por, creado_en_ip)
            VALUES(:titulo, :link, :hora, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':link', $datos["link"], PDO::PARAM_STR);
        $stmt->bindParam(':hora', $datos["hora"], PDO::PARAM_STR);
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
    Editar Transmisión
    ==========================================*/
    static public function mdlEditarTransmision($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET titulo = :titulo, link_transmision = :link, hora_finalizacion = :hora,
            modificado_por = :modificado_por, modificado_en_ip = :modificado_en_ip, modificado_el = :modificado_el
            WHERE id = :id"
        );

        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':link', $datos["link"], PDO::PARAM_STR);
        $stmt->bindParam(':hora', $datos["hora"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
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
    Eliminar Transmisión
    ==========================================*/
    static public function mdlEliminarTransmision($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip, modificado_el = :modificado_el
            WHERE id = :id"
        );

        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
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
    Finalizar o Poner en Curso Transmisión
    ==========================================*/
    static public function mdlEstadoTransmision($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET estado = :estado, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip, modificado_el = :modificado_el
            WHERE id = :id"
        );

        $stmt->bindParam(':estado', $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $datos["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $datos["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_el', $datos["modificado_el"], PDO::PARAM_STR);
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