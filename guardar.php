<?php

// Obtener URL de PostgreSQL desde render (cuando subas)
$url = getenv("postgresql://pruebajmeter_user:yHBGhnk2F0WWevKdJOnbkNlELsyNDJl6@dpg-d4ka69npm1nc73ahrdjg-a.oregon-postgres.render.com/pruebajmeter");

if (!$url) {
    die("❌ DATABASE_URL no encontrada. Aún no estás en Render.");
}

// Convertir URL en partes
$db = parse_url($url);

// Conectar
$conn = pg_connect(
  "host={$db['host']} 
  port={$db['port']} 
  dbname=" . ltrim($db['path'], '/') . " 
  user={$db['user']} 
  password={$db['pass']}"
);

if (!$conn) {
    die("❌ Error de conexión a PostgreSQL");
}

// Obtener datos POST
$nombre  = pg_escape_string($conn, $_POST["nombre"]);
$ip      = pg_escape_string($conn, $_POST["ip"]);
$tipo    = pg_escape_string($conn, $_POST["tipo"]);
$estatus = pg_escape_string($conn, $_POST["estatus"]);

// Insertar
$sql = "INSERT INTO dispositivos (nombre, ip, tipo, estatus, created_at, updated_at)
        VALUES ('$nombre', '$ip', '$tipo', '$estatus', NOW(), NOW())";

$result = pg_query($conn, $sql);

if ($result) {
    echo "✅ Dispositivo guardado correctamente";
} else {
    echo "❌ Error al guardar dispositivo";
}

pg_close($conn);
?>
