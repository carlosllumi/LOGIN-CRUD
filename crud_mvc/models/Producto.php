
<?php

require_once __DIR__ . "/../config/database.php";

class Producto {

    public static function listar() {
        $db = Database::conectar();

        $sql = "SELECT * FROM productos ORDER BY id DESC";

        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        $db = Database::conectar();

        $sql = "SELECT * FROM productos WHERE id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function crear($nombre, $precio, $cantidad) {
        $db = Database::conectar();

        $sql = "INSERT INTO productos
                (nombre, precio, cantidad)
                VALUES (?, ?, ?)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            $nombre,
            $precio,
            $cantidad
        ]);
    }

    public static function actualizar($id, $nombre, $precio, $cantidad) {
        $db = Database::conectar();

        $sql = "UPDATE productos
                SET nombre = ?, precio = ?, cantidad = ?
                WHERE id = ?";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            $nombre,
            $precio,
            $cantidad,
            $id
        ]);
    }

    public static function eliminar($id) {
        $db = Database::conectar();

        $sql = "DELETE FROM productos WHERE id = ?";

        $stmt = $db->prepare($sql);

        return $stmt->execute([$id]);
    }
}
