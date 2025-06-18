<?php
$session = session();
$rol = $session->get("ID_Rol");
?>

<?php if ($rol != 5): ?>
  <p>No tenés permiso para ver esta página, mostro.</p>
  <?php return; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dispositivos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 30px;
      background-color: #f2f2f2;
    }

    h1 {
      color: #3498db;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #3498db;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .btn-agregar {
      margin-top: 20px;
      display: inline-block;
      background-color: #2ecc71;
      color: white;
      padding: 10px 20px;
      border: none;
      text-decoration: none;
      border-radius: 5px;
      transition: 0.3s;
    }

    .btn-agregar:hover {
      background-color: #27ae60;
    }
  </style>
</head>
<body>
  <h1>Lista de Dispositivos</h1>

  <?php if (!empty($dispositivos)): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>MAC</th>
        <th>Estado</th>
      </tr>
      <?php foreach ($dispositivos as $d): ?>
        <tr>
          <td><?= esc($d['nombre']) ?></td>
          <td><?= esc($d['mac_address']) ?></td>
          <td><?= esc($d['estado']) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No hay dispositivos registrados todavía, papurri.</p>
  <?php endif; ?>

  <a class="btn-agregar" href="<?= site_url('configurar-dispositivo') ?>">
    <i class="fas fa-plus"></i> Agregar Dispositivo
  </a>
</body>
</html>
