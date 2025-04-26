<!DOCTYPE html>
<html>
<head>
    <title>Prueba de Conexión PostgreSQL</title>
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
        <h1>Prueba de Conexión PostgreSQL</h1>

        <?php
        // Parámetros de conexión - reemplaza con tus valores reales
        $host = getenv('POSTGRES_HOST') ?: 'postgresql-prd-marlon.postgres.database.azure.com';
        $user = getenv('POSTGRES_USER') ?: 'azureuser';
        $password = getenv('POSTGRES_PASSWORD') ?: '@Marlonmorales10';
        $dbname = getenv('POSTGRES_DB') ?: 'postgres';  // Base de datos por defecto
        
        echo "<div class='info'>
            <p>Intentando conectar al servidor PostgreSQL:</p>
            <p>Servidor: {$host}</p>
            <p>Usuario: {$user}</p>
            <p>Base de datos: {$dbname}</p>
        </div>";
        
        // Crear conexión
        try {
            $conn_string = "host={$host} port=5432 dbname={$dbname} user={$user} password={$password} sslmode=require";
            $conn = pg_connect($conn_string);
            
            if (!$conn) {
                throw new Exception("Error al conectar a PostgreSQL: " . pg_last_error());
            }
            
            echo "<div class='card'>
                <h2 class='success'>¡Conexión exitosa!</h2>
                <p>Conexión establecida correctamente al servidor PostgreSQL.</p>
            </div>";
            
            // Ejecutar una consulta simple
            $result = pg_query($conn, "SELECT version()");
            
            if ($result) {
                $row = pg_fetch_row($result);
                echo "<div class='card'>
                    <h3>Información de versión PostgreSQL:</h3>
                    <p>{$row[0]}</p>
                </div>";
            }
            
            pg_close($conn);
            
        } catch (Exception $e) {
            echo "<div class='card'>
                <h2 class='error'>Error de conexión</h2>
                <p>" . $e->getMessage() . "</p>
                <h3>Resolución de problemas:</h3>
                <ul>
                    <li>Verifica el nombre del servidor, usuario y contraseña</li>
                    <li>Comprueba si las reglas NSG permiten el puerto 5432</li>
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