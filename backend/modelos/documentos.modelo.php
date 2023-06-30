<?php
require_once "conexion.php";

class ModeloDocumentos {

    // ====================================================== //
    // ================= Mostrar Documentos ================= //
    // ====================================================== //
    static public function mdlMostrarDocumentos($tabla1, $tabla2, $tabla3, $item, $valor) {
        
        if($item != null && $valor != null) {

            $stmt = Conexion::conectar() -> prepare("SELECT d.id AS id,
            ie.id AS id_estructura,
            ie.titulo AS estructura,
            c.id AS id_catalogo,
            c.descripcion AS catalogo,
            d.titulo_doc AS titulo,
            d.descripcion_doc AS descripcion,
            d.nombre_imagen_subida AS imagen,
            d.archivo_nombre_subido_doc AS archivo
            FROM $tabla1 d
            INNER JOIN $tabla2 c
            ON c.id = d.categoria_doc_id
            INNER JOIN $tabla3 ie
            ON ie.id = d.estructura_id
            WHERE c.pasivo = 0
            AND d.pasivo = 0
            AND ie.pasivo = 0
            AND d.$item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        } else {

            $stmt = Conexion::conectar() -> prepare("SELECT d.id AS id,
            ie.id AS id_estructura,
            ie.titulo AS estructura,
            c.id AS id_catalogo,
            c.descripcion AS catalogo,
            d.titulo_doc AS titulo,
            d.descripcion_doc AS descripcion,
            d.nombre_imagen_subida AS imagen,
            d.archivo_nombre_subido_doc AS archivo
            FROM $tabla1 d
            INNER JOIN $tabla2 c
            ON c.id = d.categoria_doc_id
            INNER JOIN $tabla3 ie
            ON ie.id = d.estructura_id
            WHERE c.pasivo = 0
            AND d.pasivo = 0
            AND ie.pasivo = 0
            ORDER BY d.id DESC");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt = null;
    }

    /*==========================================
    Obtener el consecutivo del proximo documento
    ==========================================*/
    static public function mdlRegistroConsecutivo() {

        $stmt = Conexion::conectar()->prepare(
            "SELECT
                CASE 
                    WHEN MAX(id) IS NULL THEN 1
                    ELSE MAX(id)+1
                END AS id
            FROM documento"
        );

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

        $stmt = null;
    }

    /*==========================================
    Registro Documento
    ==========================================*/
    static public function mdlRegistroDocumento($tabla, $datos) {
        
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(estructura_id, categoria_doc_id, titulo_doc, descripcion_doc,
            archivo_nombre_subido_doc, nombre_imagen_subida, creado_por, creado_en_ip)
            VALUES(:estructura_id, :categoria_id, :titulo, :descripcion, :archivo, :imagen, :creado_por, :creado_en_ip)"
        );

        $stmt->bindParam(':estructura_id', $datos["estructura_id"], PDO::PARAM_INT);
        $stmt->bindParam(':categoria_id', $datos["categoria_id"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(':archivo', $datos["archivo"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
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
    Editar Documento
    ==========================================*/
    static public function mdlEditarDocumento($tabla, $datos){

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET estructura_id = :estructura_id, categoria_doc_id = :categoria_id,
            titulo_doc = :titulo, descripcion_doc = :descripcion, archivo_nombre_subido_doc = :archivo,
            nombre_imagen_subida = :imagen, modificado_el = :modificado_el, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':estructura_id', $datos["estructura_id"], PDO::PARAM_INT);
        $stmt->bindParam(':categoria_id', $datos["categoria_id"], PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(':archivo', $datos["archivo"], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos["imagen"], PDO::PARAM_STR);
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

    static public function mdlEliminarDocumento($tabla, $data){
        
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla SET pasivo = true, modificado_el = :modificado_el, modificado_por = :modificado_por,
            modificado_en_ip = :modificado_en_ip
            WHERE id = :id"
        );

        $stmt->bindParam(':modificado_el', $data["modificado_el"], PDO::PARAM_STR);
        $stmt->bindParam(':modificado_por', $data["modificado_por"], PDO::PARAM_INT);
        $stmt->bindParam(':modificado_en_ip', $data["modificado_en_ip"], PDO::PARAM_STR);
        $stmt->bindParam(':id', $data["id"], PDO::PARAM_INT);

        if($stmt -> execute()) {

            return "ok";

        } else {

            echo "\nPDO::errorInfo():\n";
            print_r(Conexion::conectar()->errorInfo());

        }
        $stmt = null;

    }

}