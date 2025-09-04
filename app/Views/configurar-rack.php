<?php
$session = session();
$rol = $session->get("ID_Rol");
?>

<?php if ($rol != 5): ?>
  <p>No tenés permiso para ver esta página.</p>
  <?php return; ?>
<?php endif; ?>

<!doctype html>
<html lang="es">
<head>
    <title>Agregar Rack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; padding: 30px; }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        form { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); max-width: 500px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #2c3e50; }
        input[type="text"], select { width: 100%; padding: 8px 12px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
        button { background-color: #2ecc71; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #27ae60; }
    </style>
</head>
<body>
    <h1>Agregar Rack Nuevo</h1>

    <form action="<?= site_url('guardar-rack') ?>" method="post">
        <label for="nombre">Nombre del Rack</label>
        <input type="text" name="nombre" id="nombre" required placeholder="Ej: Rack Puerto Madero">

        <label for="ubicacion">Ubicación</label>
        <input type="text" name="ubicacion" id="ubicacion" required placeholder="Ej: Puerto Madero">

        <label for="estado">Estado</label>
        <select name="estado" id="estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>

        <button type="submit"><i class="fas fa-plus"></i> Agregar Rack</button>
    </form>
</body>
</html>
