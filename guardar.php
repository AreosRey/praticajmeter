<?php
// guardar.php (Versión con PDO)

// 1. Incluir el archivo de conexión
require_once 'db.php';

try {
    // 2. Obtener la conexión PDO
    $pdo = getDbConnection();

    // 3. Obtener datos POST
    // PDO ya manejará la seguridad con sentencias preparadas,
    // por lo que no necesitamos pg_escape_string.
    $nombre  = $_POST["nombre"];
    $ip      = $_POST["ip"];
    $tipo    = $_POST["tipo"];
    $estatus = $_POST["estatus"];

    // 4. Escribir la consulta SQL usando marcadores de posición (?)
    $sql = "INSERT INTO dispositivos (nombre, ip, tipo, estatus, created_at, updated_at)
            VALUES (?, ?, ?, ?, NOW(), NOW())";

    // 5. Preparar la consulta
    $stmt = $pdo->prepare($sql);

    // 6. Ejecutar la consulta, pasando las variables en un array
    // PDO se encarga de escapar y sanitizar automáticamente.
    $stmt->execute([$nombre, $ip, $tipo, $estatus]);

    echo "✅ Dispositivo guardado correctamente";

} catch (PDOException $e) {
    // Capturar cualquier error en la consulta
    echo "❌ Error al guardar dispositivo: " . $e->getMessage();
}

// 7. Cerrar la conexión (opcional)
closeDbConnection();
?>