<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Dispositivo</title>
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
      background-color: #3498db;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover { background-color: #2980b9; }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Agregar Nuevo Dispositivo</h2>
    <form action="<?= site_url('/guardar-dispositivo') ?>" method="post">
      <label>Nombre del dispositivo:</label>
      <input type="text" name="nombre" required>

      <label>Dirección MAC:</label>
      <input type="text" name="mac" required>

      <label>Estado:</label>
      <select name="estado">
        <option value="activo">Activo</option>
        <option value="inactivo">Inactivo</option>
      </select>

      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>