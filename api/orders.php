<?php
// Incluye la configuración, middleware de autenticación y el controlador de órdenes.
require_once '../config/config.php';  // Configuración de la base de datos y otras constantes.
require_once '../middlewares/AuthMiddleware.php';  // Middleware para autenticar las solicitudes.
require_once '../controllers/OrdersController.php';  // Controlador para gestionar las órdenes.

try {
    // Establece una conexión a la base de datos utilizando PDO.
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Establece el modo de error de PDO.

    // Llama a la función de autenticación para validar el token.
    authenticate();

    // Verifica si la solicitud es de tipo GET.
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Obtiene los parámetros 'status' y 'month' de la consulta, si existen.
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $month = isset($_GET['month']) ? $_GET['month'] : '';
        
        // Llama a la función getOrders del controlador para recuperar las órdenes filtradas.
        getOrders($db, $status, $month);
    } else {
        // Si la solicitud no es de tipo GET, devuelve un error 404.
        http_response_code(404);
        echo json_encode(['error' => 'Endpoint not found: ' . $_SERVER['REQUEST_URI']]);
    }
} catch (PDOException $e) {
    // Maneja errores de conexión a la base de datos y devuelve un error 500 en formato JSON.
    respondWithJson(['error' => 'Database connection error: ' . $e->getMessage()], 500);
}

