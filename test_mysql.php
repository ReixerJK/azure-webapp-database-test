<!DOCTYPE html>
<html>
<head>
    <title>Prueba de Conexión MySQL</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .success { color: green; }
        .error { color: red; }
        .info { background: #e6f7ff; padding: 10px; border-left: 4px solid #0078d4; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prueba de Conexión MySQL</h1>

        <?php
        // Parámetros de conexión - reemplaza con tus valores reales
        $server = getenv('MYSQL_HOST') ?: 'mysql-prod-marlon.mysql.database.azure.com';
        $username = getenv('MYSQL_USER') ?: 'azureuser';
        $password = getenv('MYSQL_PASSWORD') ?: '@Marlonmorales10';
        $database = getenv('MYSQL_DB') ?: 'mysql';  // Base de datos por defecto
        
        echo "<div class='info'>
            <p>Intentando conectar al servidor MySQL:</p>
            <p>Servidor: {$server}</p>
            <p>Usuario: {$username}</p>
            <p>Base de datos: {$database}</p>
        </div>";
        
        // Crear conexión
        try {
            $conn = new mysqli($server, $username, $password, $database);
            
            // Verificar conexión
            if ($conn->connect_error) {
                throw new Exception("Conexión fallida: " . $conn->connect_error);
            }
            
            echo "<div class='card'>
                <h2 class='success'>¡Conexión exitosa!</h2>
                <p>Conexión establecida correctamente al servidor MySQL.</p>
                <p>Versión del servidor: " . $conn->server_info . "</p>
            </div>";
            
            // Ejecutar una consulta simple
            $sql = "SELECT VERSION() as version";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='card'>
                    <h3>Información de versión MySQL:</h3>
                    <p>" . $row["version"] . "</p>
                </div>";
            }
            
            $conn->close();
            
        } catch (Exception $e) {
            echo "<div class='card'>
                <h2 class='error'>Error de conexión</h2>
                <p>" . $e->getMessage() . "</p>
                <h3>Resolución de problemas:</h3>
                <ul>
                    <li>Verifica el nombre del servidor, usuario y contraseña</li>
                    <li>Comprueba si las reglas NSG permiten el puerto 3306</li>
                    <li>Verifica que la integración VNet esté configurada correctamente</li>
                    <li>Revisa si el servidor de base de datos permite conexiones desde esta subred</li>
                </ul>
            </div>";
        }
        ?>
        
        <p><a href="index.php">Volver a la página principal</a></p>
    </div>
</body>
</html>