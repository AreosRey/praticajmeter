<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar dispositivo</title>
</head>
<body>

  <h2>Formulario de dispositivos</h2>

  <form action="guardar.php" method="POST">

    <label>Nombre del dispositivo:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Dirección IP:</label><br>
    <input type="text" name="ip" required><br><br>

    <label>Tipo:</label><br>
    <select name="tipo" required>
      <option value="sensor">Sensor</option>
      <option value="router">Router</option>
      <option value="torre">Torre</option>
    </select><br><br>

    <label>Estatus:</label><br>
    <select name="estatus" required>
      <option value="activo">Activo</option>
      <option value="inactivo">Inactivo</option>
      <option value="panel_solar">Panel Solar</option>
    </select><br><br>

    <button type="submit">Guardar</button>

  </form>

</body>
</html>
