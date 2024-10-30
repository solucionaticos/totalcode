// Función para formatear números con separador de miles
function numberFormat(valor) {
    const roundedValue = Math.round(valor);
    return roundedValue.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Cuando el documento esté listo
$(document).ready(function() {
    const apiToken = 'T0t@lC0d3***'; // Token para autenticación de la API
    const pathProject = 'totalcode'; // Carpeta del proyecto

    // Función para cargar órdenes desde la API
    function loadOrders() {
        const status = $('#status').val(); // Estado de orden seleccionado
        const month = $('#month').val(); // Mes seleccionado

        let totalNumOrders = 0; // Contador de total de órdenes
        let totalOrders = 0; // Total de monto de órdenes
        let numRegistros = 0; // Contador de registros

        fetch('http://localhost/' + pathProject + '/api/orders.php?status=' + status + '&month=' + month, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + apiToken,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Error en la respuesta: ' + response.status);
            return response.json();
        })
        .then(data => {
            // Limpia el cuerpo de la tabla
            $('#orderTable').empty();

            // Rellena la tabla con los datos obtenidos de la API
            data.forEach(order => {
                totalNumOrders += parseInt(order.qty); // Suma al total de órdenes
                totalOrders += parseFloat(order.grandTotal); // Suma al total de montos
                numRegistros++; // Incrementa el contador de registros

                $('#orderTable').append(`
                    <tr>
                        <td></td>
                        <td>
                            <span class="text-uppercase text-grey-dark text-bold">${order.first_name} ${order.last_name}</span>
                            <br>
                            ${order.email}
                        </td>
                        <td>${order.qty}</td>
                        <td>$ ${numberFormat(order.grandTotal)}</td>
                        <td></td>
                    </tr>
                `);
            });

            // Actualiza los totales en la tabla
            $("#totalNumOrders").html(numberFormat(totalNumOrders));
            $("#totalOrders").html('$ ' + numberFormat(totalOrders));
            $("#numRegistros").html(numberFormat(numRegistros));
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
            alert('No se pudo conectar al servicio.');
        });
    }

    loadOrders(); // Carga las órdenes inicialmente

    // Recarga las órdenes cada vez que cambia un filtro
    $('.filter').on('change', function() {
        loadOrders();
    });
});