<?php
/**
 * Clase Order
 * 
 * Esta clase maneja la consulta de datos de la tabla `orders` en la base de datos.
 * Permite obtener un resumen de las órdenes con la posibilidad de filtrar por estado y mes.
 */
class Order {
    // Propiedad para almacenar la conexión de la base de datos
    private $db;

    /**
     * Constructor de la clase Order
     * 
     * @param PDO $db Instancia de la conexión a la base de datos.
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Método getOrders
     * 
     * Obtiene un resumen de órdenes de la tabla `orders`, filtrando por estado y mes si se proporcionan.
     * 
     * @param string $status (opcional) Estado de las órdenes para filtrar (por ejemplo, 'ABIERTAS', 'ENVIADAS', 'ENTREGADAS').
     * @param string $month (opcional) Mes de las órdenes para filtrar (número de 1 a 12).
     * @return array Retorna un arreglo con el resumen de las órdenes, incluyendo cantidad (`qty`),
     *               total (`grandTotal`), nombre (`first_name`), apellido (`last_name`), y email del cliente.
     */
    public function getOrders($status = '', $month = '') {
        // Se define la cláusula base WHERE y un arreglo para los parámetros de consulta
        $where = " WHERE 1=1";
        $params = [];

        // Agregar filtro por estado si está especificado
        if ($status !== '') {
            $where .= " AND status = :status";
            $params[':status'] = $status;
        }

        // Agregar filtro por mes si está especificado
        if ($month !== '') {
            $where .= " AND MONTH(date_placed) = :month";
            $params[':month'] = $month;
        }

        // Consulta SQL para obtener el resumen de órdenes con posibles filtros
        $query = "
            SELECT 
                COUNT(order_num) AS qty, SUM(total) AS grandTotal, 
                first_name, last_name, email  
            FROM 
                orders 
            {$where}
            GROUP BY 
                cust_code, first_name, last_name, email 
            ORDER BY 
                grandTotal DESC
        ";

        // Preparar y ejecutar la consulta con los parámetros de filtrado
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        // Retornar el resultado de la consulta como un arreglo asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
