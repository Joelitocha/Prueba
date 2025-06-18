<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Dispositivo</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 20px; }
    .form-container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px #ccc;
    }
    input[type="text"], select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      background-color: #2ecc71;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover { background-color: #27ae60; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Editar Dispositivo</h2>
    <form action="<?= site_url('/actualizar-dispositivo/'.$dispositivo['ID_Sistema']) ?>" method="post">
      <label>Nombre del dispositivo:</label>
      <input type="text" name="nombre" value="<?= $dispositivo['nombre'] ?>" required>

      <label>Dirección MAC:</label>
      <input type="text" name="mac" value="<?= $dispositivo['mac_address'] ?>" required>

      <label>Estado:</label>
      <select name="estado">
        <option value="activo" <?= $dispositivo['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
        <option value="inactivo" <?= $dispositivo['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
      </select>

      <button type="submit">Actualizar</button>
    </form>
  </div>
</body>
</html>