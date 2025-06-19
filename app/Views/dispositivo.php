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

    <!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div class="logo">
    <?= ($rol == 5) ? "Administrador" : (($rol == 6) ? "Supervisor" : "Usuario") ?>
  </div>
  
  <div class="menu-heading">Menu</div>
  <a href="<?= site_url('/bienvenido') ?>" class="menu-item active">
    <i class="fas fa-home"></i> Inicio
  </a>
  
  <?php if ($rol == 5): ?>
  <div class="menu-heading">Usuarios</div>
  <a href="<?= site_url('/modificar-usuario') ?>" class="menu-item">
    <i class="fas fa-user-edit"></i> Gestor de Usuarios
  </a>
  <?php endif; ?>
  
  <div class="menu-heading">Tarjetas</div>
  <?php if ($rol == 5): ?>
  <a href="<?= site_url('/modificar-tarjeta') ?>" class="menu-item">
    <i class="fas fa-credit-card"></i> Gestor de Tarjetas
  </a>
  <?php endif; ?>
  <a href="<?= site_url('/consultar-rfid') ?>" class="menu-item">
    <i class="fas fa-search"></i> Consultar Estado
  </a>
  
  <?php if ($rol == 5): ?>
  <div class="menu-heading">Dispositivos</div>
  <a href="<?= site_url('/dispositivo') ?>" class="menu-item">
    <i class="fas fa-microchip"></i> Gestionar Dispositivos
  </a>
  <?php endif; ?>

  <?php if ($rol == 5 || $rol == 6): ?>
  <div class="menu-heading">Reportes</div>
  <a href="<?= site_url('/ver-alertas') ?>" class="menu-item">
    <i class="fas fa-exclamation-triangle"></i> Ver Alertas
  </a>
  <a href="<?= site_url('/ver-accesos-tarjeta') ?>" class="menu-item">
    <i class="fas fa-key"></i> Ver Accesos
  </a>
  <a href="<?= site_url('/historial-cambios') ?>" class="menu-item">
    <i class="fas fa-history"></i> Historial
  </a>
  <?php endif; ?>
  
  <div class="menu-heading">Sesión</div>
  <a onclick="if(confirm('¿Cerrar sesión?')) window.location.href='<?= site_url('/logout') ?>'" class="menu-item">
    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
  </a>
</div>

<style>
/* Estilos Minimalistas para el Sidebar */
.sidebar {
  width: 250px;
  height: 100vh;
  position: fixed;
  background: #2c3e50;
  color: white;
  padding-top: 20px;
  box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}
.sidebar a {
  color: #ecf0f1;
  padding: 12px 15px;
  margin: 5px 10px;
  display: flex;
  align-items: center;
  border-radius: 4px;
  transition: all 0.3s;
  text-decoration: none;
}
.sidebar a:hover {
  background: #34495e;
}
.sidebar a i {
  margin-right: 10px;
  color: #3498db;
}
.sidebar .logo {
  text-align: center;
  font-size: 1.5rem;
  margin-bottom: 20px;
  color: #3498db;
  font-weight: bold;
}
.sidebar .menu-heading {
  padding: 10px 15px;
  margin-top: 15px;
  color: #7f8c8d;
  font-size: 0.8rem;
  text-transform: uppercase;
}
</style>

<script>
// Toggle para móviles (opcional)
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidebar');
  if (window.innerWidth < 992) {
    sidebar.style.transform = 'translateX(-100%)';
    sidebar.style.transition = 'transform 0.3s ease';
  }
});
</script>
<!--FIN DEL SIDEBAR-->

  <h1>Lista de Dispositivos</h1>

  <?php if (!empty($dispositivos)): ?>
    <table>
      <tr>
      
        <th>Nombre</th>
        <th>MAC</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
      <?php foreach ($dispositivos as $d): ?>
        <tr>
          <td><?= esc($d['nombre']) ?></td>
          <td><?= esc($d['mac_address']) ?></td>
          <td><?= esc($d['estado']) ?></td>
          <td>  <a class="btn-agregar" href="<?= site_url('configurar-dispositivo/'.$d['ID_Sistema']) ?>">
    <i class="fas fa-plus"></i> Editar Dispositivo
  </a>
<a class="btn-agregar" href="<?= site_url('eliminar-dispositivo/'.$d['ID_Sistema']) ?>">
    <i class="fas fa-plus"></i> Eliminar Dispositivo
  </a>
</td>
          
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No hay dispositivos registrados todavía.</p>
  <?php endif; ?>

  <a class="btn-agregar" href="<?= site_url('configurar-dispositivo') ?>">
    <i class="fas fa-plus"></i> Agregar Dispositivo
  </a>
</body>
</html>
