
<?php

session_start();

require_once "controllers/AuthController.php";
require_once "controllers/ProductoController.php";

$ruta = $_GET["ruta"] ?? "inicio";

if ($ruta === "login") {
    AuthController::login();
    exit;
}

if ($ruta === "inicio") {
    if (isset($_SESSION["usuario_id"])) {
        header("Location: index.php?ruta=productos");
        exit;
    }

    require "views/login.php";
    exit;
}

// Todas las rutas siguientes requieren Login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php");
    exit;
}

// Crear token para proteger formularios
if (empty($_SESSION["csrf_token"])) {
    $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

// Verificar token en solicitudes POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST["csrf_token"] ?? "";

    if (!is_string($token) ||
        !hash_equals($_SESSION["csrf_token"], $token)) {
        http_response_code(403);
        exit("Solicitud no autorizada");
    }
}

switch ($ruta) {

    case "productos":
        ProductoController::listar();
        break;

    case "guardar":
        ProductoController::guardar();
        break;

    case "eliminar":
        ProductoController::eliminar();
        break;

    default:
        http_response_code(404);
        echo "Pagina no encontrada";
        break;
}
