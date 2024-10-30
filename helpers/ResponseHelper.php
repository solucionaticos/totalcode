<?php
/**
 * Función Helper: respondWithJson
 * 
 * Envía una respuesta en formato JSON con un código de estado HTTP especificado.
 * 
 * @param mixed $data Datos a ser convertidos en JSON y enviados en la respuesta.
 * @param int $statusCode Código de estado HTTP para la respuesta (por defecto, 200).
 */

function respondWithJson($data, $statusCode = 200) {
    // Establece el código de estado HTTP de la respuesta
    http_response_code($statusCode);

    // Define el tipo de contenido de la respuesta como JSON
    header('Content-Type: application/json');

    // Convierte los datos en JSON y los envía como respuesta
    echo json_encode($data);
}

