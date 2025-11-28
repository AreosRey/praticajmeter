<?php
// db.php
// Conexión usando PDO (PHP Data Objects)

$pdo = null;

function getDbConnection() {
    global $pdo;

    // Si ya tenemos una conexión PDO, la retornamos
    if ($pdo !== null) {
        return $pdo;
    }

    // 1. Obtener la URL de PostgreSQL desde Render
    $url = getenv("postgresql://pruebajmeter_user:yHBGhnk2F0WWevKdJOnbkNlELsyNDJl6@dpg-d4ka69npm1nc73ahrdjg-a/pruebajmeter");

    if (!$url) {
        die("❌ Error: Variable de entorno DATABASE_URL no encontrada. Asegúrate de enlazar el servicio en Render.");
    }

    // 2. Convertir la URL en partes (parse_url)
    $db = parse_url($url);
    
    // Verificación básica
    if (!isset($db['host'], $db['port'], $db['path'], $db['user'], $db['pass'])) {
        die("❌ Error: El formato de DATABASE_URL es inválido.");
    }

    // Extraer y limpiar los componentes
    $host = $db['host'];
    $port = $db['port'];
    $dbname = ltrim($db['path'], '/'); // Quita la barra inicial
    $user = $db['user'];
    $pass = $db['pass'];

    // 3. Crear el string DSN (Data Source Name)
    // Usamos 'pgsql' para PDO con PostgreSQL
    $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";

    try {
        // 4. Crear la nueva conexión PDO
        $pdo = new PDO($dsn, $user, $pass);
        
        // 5. Configurar el modo de error para que PDO lance excepciones
        // Esto es crucial para un buen manejo de errores con try...catch
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;

    } catch (PDOException $e) {
        // Capturar cualquier error de conexión
        die("❌ Error de conexión a PostgreSQL: " . $e->getMessage());
    }
}

// Opcional: Función para cerrar la conexión (PDO no requiere cierre explícito
// como pg_close, pero podemos establecer $pdo a null)
function closeDbConnection() {
    global $pdo;
    $pdo = null;
}
?>