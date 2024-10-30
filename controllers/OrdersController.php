<?php
// Incluye el modelo Order y el helper ResponseHelper para gestionar las órdenes y enviar respuestas en formato JSON.
require_once '../models/Order.php';
require_once '../helpers/ResponseHelper.php';

/**
 * Obtiene las órdenes de acuerdo a un estado y/o un mes específico.
 *
 * @param PDO $db Instancia de la conexión a la base de datos.
 * @param string $status (Opcional) Estado de las órdenes a filtrar.
 * @param string $month (Opcional) Mes de las órdenes a filtrar.
 * 
 * @return void La respuesta se envía en formato JSON con la lista de órdenes filtradas.
 */
function getOrders($db, $status, $month) {
    // Crea una instancia del modelo Order.
    $orderModel = new Order($db);
    
    // Llama al método getOrders() para obtener las órdenes según el estado y/o mes proporcionados.
    $orders = $orderModel->getOrders($status, $month);
    
    // Envía la respuesta en formato JSON con la lista de órdenes filtradas.
    respondWithJson($orders);
}
