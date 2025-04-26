<!DOCTYPE html>
<html>
<head>
    <title>Prueba de Conexión a Bases de Datos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        button { padding: 10px 15px; background: #0078d4; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prueba de Conexión a Bases de Datos en Azure</h1>
        
        <div class="card">
            <h2>Probar Conexión a MySQL</h2>
            <p>Prueba la conexión a tu servidor MySQL Flexible en la subred PRD.</p>
            <a href="test_mysql.php"><button>Probar Conexión MySQL</button></a>
        </div>
        
        <div class="card">
            <h2>Probar Conexión a PostgreSQL</h2>
            <p>Prueba la conexión a tu servidor PostgreSQL Flexible en la subred PRD.</p>
            <a href="test_postgres.php"><button>Probar Conexión PostgreSQL</button></a>
        </div>
    </div>
</body>
</html>