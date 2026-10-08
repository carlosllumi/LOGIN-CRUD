
<?php

require_once __DIR__ . "/../config/database.php";

class Usuario {

    public static function buscar($usuario) {

        $conexion = Database::conectar();

        $sql = "SELECT * FROM usuarios
                WHERE usuario = :usuario
                LIMIT 1";

        $stmt = $conexion->prepare($sql);

        $stmt->execute([
            ":usuario" => $usuario
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
