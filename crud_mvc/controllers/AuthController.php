
<?php

require_once __DIR__ . "/../models/Usuario.php";

class AuthController {

    public static function login() {

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php");
            exit;
        }

        $usuario = trim($_POST["usuario"] ?? "");
        $password = $_POST["password"] ?? "";

        $datos = Usuario::buscar($usuario);

        if ($datos && password_verify(
            $password,
            $datos["password"]
        )) {

            session_regenerate_id(true);

            $_SESSION["usuario_id"] = $datos["id"];
            $_SESSION["usuario"] = $datos["usuario"];

            header("Location: index.php?ruta=productos");
            exit;

        } else {

            $_SESSION["error"] =
                "Usuario o contraseña incorrectos";

            header("Location: index.php");
            exit;
        }
    }
}
