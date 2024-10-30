<?php
/**
 * Middleware de Autenticación
 * 
 * Esta función verifica que la solicitud tenga un encabezado de autenticación válido
 * para permitir el acceso a recursos protegidos. En caso de fallo de autenticación,
 * retorna un código de estado 401 y un mensaje de error en formato JSON.
 */

function authenticate() {
    // Obtener los encabezados de la solicitud
    $headers = apache_request_headers();

    // Verificar si el encabezado 'Authorization' está presente y coincide con el token esperado
    if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer ' . API_TOKEN) {
        // En caso de que la autenticación falle, se establece el código de respuesta HTTP 401 (No autorizado)
        http_response_code(401);

        // Enviar un mensaje de error en formato JSON
        echo json_encode(['error' => 'Unauthorized']);
        
        // Detener la ejecución del script
        exit;
    }
}
