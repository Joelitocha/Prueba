<?php
$session = session();
$rol = $session->get("ID_Rol");
?>

<?php if ($rol != 5): ?>
  <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px;">No tenés permiso para ver esta página.</p>
  <?php return; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dispositivos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
      background-color: #f5f5f5;
    }

    /* Sidebar */
    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #2b2b2b;
      padding-top: 20px;
      color: #fff;
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
      overflow-y: auto;
      z-index: 1000;
      transition: transform 0.3s ease;
    }

    .sidebar a {
      padding: 12px 15px;
      text-decoration: none;
      font-size: 15px;
      color: #fff;
      display: flex;
      align-items: center;
      margin: 8px 15px;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    .sidebar a:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar a.active {
      background-color: #4a4a4a;
    }

    .sidebar a i {
      margin-right: 10px;
      color: #3498db;
    }

    .sidebar .logo {
      text-align: center;
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 25px;
      color: #3498db;
    }

    .menu-heading {
      padding: 10px 15px;
      margin-top: 20px;
      font-size: 13px;
      color: #3498db;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Contenido */
    .content {
      margin-left: 250px;
      padding: 30px;
      min-height: 100vh;
      transition: margin-left 0.3s ease;
    }

    h1 {
      color: #3498db;
      font-weight: 600;
      margin-bottom: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      background-color: #3498db;
      color: white;
      font-weight: 500;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .btn-action {
      padding: 8px 12px;
      border-radius: 4px;
      font-size: 14px;
      font-weight: 500;
      margin-right: 5px;
      color: white;
      text-decoration: none;
      display: inline-block;
    }

    .btn-edit {
      background-color: #f39c12;
    }

    .btn-delete {
      background-color: #e74c3c;
    }

    .btn-add {
      background-color: #2ecc71;
      padding: 10px 20px;
      margin-top: 20px;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .sidebar {
        transform: translateX(-100%);
      }
      
      .content {
        margin-left: 0;
      }
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
    <a href="<?= site_url('/bienvenido') ?>" class="menu-item">
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
    <a href="<?= site_url('/dispositivo') ?>" class="menu-item active">
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

  <!-- Contenido principal -->
  <div class="content">
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
            <td>
              <a class="btn-action btn-edit" href="<?= site_url('configurar-dispositivo/'.$d['ID_Sistema']) ?>">
                <i class="fas fa-edit"></i> Editar
              </a>
              <a class="btn-action btn-delete" href="<?= site_url('eliminar-dispositivo/'.$d['ID_Sistema']) ?>">
                <i class="fas fa-trash"></i> Eliminar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p>No hay dispositivos registrados todavía.</p>
    <?php endif; ?>

    <a class="btn-action btn-add" href="<?= site_url('configurar-dispositivo') ?>">
      <i class="fas fa-plus"></i> Agregar Dispositivo
    </a>
  </div>

  <script>
    // Toggle para móviles
    document.addEventListener('DOMContentLoaded', function() {
      const menuToggle = document.getElementById('menuToggle');
      const sidebar = document.getElementById('sidebar');
      
      if (window.innerWidth <= 992) {
        menuToggle.style.display = 'block';
        sidebar.style.transform = 'translateX(-100%)';
        
        menuToggle.addEventListener('click', () => {
          sidebar.classList.toggle('active');
        });

        document.querySelectorAll('.sidebar a').forEach(item => {
          item.addEventListener('click', () => {
            if (window.innerWidth <= 992) {
              sidebar.classList.remove('active');
            }
          });
        });
      }

      window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
          menuToggle.style.display = 'none';
          sidebar.style.transform = 'translateX(0)';
        } else {
          menuToggle.style.display = 'block';
        }
      });
    });
  </script>
</body>
</html>