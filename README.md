PROYECTO TOTALCODE

    Este repositorio contiene el proyecto TotalCode, el cual incluye scripts para la gestión y visualización de pedidos a través de una API. La aplicación utiliza tecnologías de frontend y backend para realizar operaciones de consulta y manipulación de datos, junto con algunos archivos de estilo y componentes CSS.

----------------------------------------------------------------------------------

TABLA DE CONTENIDOS

    1. Requisitos
    2. Descripción de los Archivos
    3. Instalación
    4. Configuración del Proyecto
    5. Ejecución
    6. Endpoint de la API
    7. Ejemplo de solicitud a la API

----------------------------------------------------------------------------------

1. REQUISITOS

    Para ejecutar este proyecto correctamente, asegúrate de tener los siguientes requisitos previos instalados en tu sistema:

        a. Servidor local (XAMPP, WAMP, o LAMP)
        b. Base de datos: MySQL
        c. Navegador actualizado
        d. Acceso a la API con un token de autenticación válido

----------------------------------------------------------------------------------

2. DESCRIPCIÓN DE LOS ARCHIVOS

    index.html: 
        Página principal de la aplicación.

    README.md: 
        Aclaraciones e inducción sobre como iniciar el proyecto para su revisión.

    api/orders.php: 
        Incluye la configuración, middleware de autenticación y el controlador de órdenes.

    config/config.php: 
        Configuración de constantes para la conexión a la base de datos y autenticación de la API.

    controllers/OrdersController.php: 
        Incluye el modelo Order y el helper ResponseHelper para gestionar las órdenes y enviar respuestas en formato JSON.

    css/style.css: 
        Estilos principales de la interfaz de usuario. contiene estilos globales, de diseño y responsivos. Consulta los comentarios dentro del archivo para comprender cómo aplicar y modificar cada clase de estilo.

    helper/ResponseHelper.php: 
        Envía una respuesta en formato JSON con un código de estado HTTP especificado.

    images/logo-total.png: 
        Logo del proyecto

    js/report.js: 
        Contiene el código de JavaScript para la comunicación con la API, incluidas las configuraciones de fetch y gestión de respuestas.

    middleware/AuthMiddleware.php: 
        Esta función verifica que la solicitud tenga un encabezado de autenticación válido para permitir el acceso a recursos protegidos. En caso de fallo de autenticación, retorna un código de estado 401 y un mensaje de error en formato JSON.

    models/Order.php: 
        Esta clase maneja la consulta de datos de la tabla `orders` en la base de datos.  Permite obtener un resumen de las órdenes con la posibilidad de filtrar por estado y mes.

    sql/orders.sql: 
        SQLs de creación de la tabla orders y de populación de datos

----------------------------------------------------------------------------------

3. INSTALACIÓN

    Configura el servidor web: Coloca los archivos del proyecto en el directorio de tu servidor local (por ejemplo, htdocs para XAMPP) para poder realizar las consultas desde el navegador.

    Clona este repositorio:

        git clone git@github.com:solucionaticos/TotalCodeTest.git
        cd TotalCodeTest

    NOTA: 
        Puedes definir el nombre de la carpeta del proyecto como desees, y este mismo nombre debes definirlo en js/report.js con la constante pathProject

----------------------------------------------------------------------------------

4. CONFIGURACIÓN DEL PROYECTO

    a. La aplicación realizará solicitudes a la API de pedidos con el token de autenticación proporcionado en el archivo config/config.php en la constante API_TOKEN y en js/report.js la constante apiToken, debes validar que las dos constantes tengan el mismo token.
    b. Debes definir la carpeta del proyecto en js/report.js con la constante pathProject.
    c. Crea la base de datos, la tabla orders y populala con los datos que se encuentran en sql/orders.sql
    d. Verifica los valores para realizar la conexión a la base de datos en config/config.php

----------------------------------------------------------------------------------

5. EJECUCIÓN

    Para iniciar el proyecto, asegúrate de que tu servidor local está activo y sigue los pasos:

        a. Ejecuta el servidor web: Activa tu servidor local (ej., Apache en XAMPP o WAMP) y verifica que los archivos se encuentren en la ruta http://localhost/totalcode/.
        b. Accede a la aplicación: Abre tu navegador y navega a la ruta del proyecto y ejecuta http://localhost/totalcode/index.html.

----------------------------------------------------------------------------------

6. ENDPOINT DE LA API

    A continuación, una descripción del endpoint principal utilizado, devuelve una lista de pedidos según el estado y el mes seleccionados.:
        
        Metodo: 
            GET 
        URL: 
            http://localhost/totalcode/api/orders.php?status=&month=
        Parámetros: 
            status (opcional)
            month (opcional)
        Headers:
        	'Authorization': 'Bearer ' + apiToken
        	'Content-Type': 'application/json'

----------------------------------------------------------------------------------

7. EJEMPLO DE SOLICITUD A LA API

    El archivo js/report.js incluye un fragmento de código que realiza una solicitud a la API para consultar los pedidos según el estado (status) y el mes (month).

        fetch('http://localhost/' + pathProject + '/api/orders.php?status=' + status + '&month=' + month, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + apiToken,
                'Content-Type': 'application/json'
            }
        })


