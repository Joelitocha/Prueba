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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* Estilos del Sidebar */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
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
      scrollbar-width: none;
      z-index: 1000;
      transition: transform 0.3s ease;
    }

    .sidebar::-webkit-scrollbar {
      display: none;
    }

    .sidebar a {
      padding: 12px 15px;
      text-decoration: none;
      font-size: 16px;
      color: #fff;
      display: flex;
      align-items: center;
      margin: 8px 15px;
      border-radius: 6px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .sidebar a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 15px rgba(52, 152, 219, 0.3);
    }

    .sidebar a i {
      margin-right: 10px;
      font-size: 18px;
      color: #3498db;
      transition: transform 0.3s ease;
    }

    .sidebar a:hover i {
      transform: scale(1.15);
    }

    .sidebar a.active {
      background-color: #4a4a4a;
      box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .sidebar a.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 4px;
      background-color: #3498db;
    }

    .sidebar .logo {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #3498db;
      padding: 0 15px;
    }

    .sidebar .menu-heading {
      padding: 10px 15px;
      text-transform: uppercase;
      font-weight: bold;
      margin-top: 25px;
      font-size: 14px;
      color: #3498db;
      letter-spacing: 1px;
    }

    /* Contenido principal */
    .content {
      margin-left: 250px;
      padding: 30px;
      transition: margin-left 0.3s ease;
      background-color: #f2f2f2;
      min-height: 100vh;
    }

    /* Estilos específicos de la vista de dispositivos */
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
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
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

    .btn-action {
      display: inline-block;
      color: white;
      padding: 8px 15px;
      border: none;
      text-decoration: none;
      border-radius: 5px;
      transition: 0.3s;
      margin-right: 5px;
      font-size: 14px;
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

    .btn-action:hover {
      opacity: 0.9;
    }

    .btn-action i {
      margin-right: 5px;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .sidebar {
        transform: translateX(-100%);
      }
      
      .sidebar.active {
        transform: translateX(0);
      }
      
      .content {
        margin-left: 0;
      }
      
      .menu-toggle {
        display: block;
      }
    }

    @media (max-width: 768px) {
      .content {
        padding: 20px;
      }
      
      th, td {
        padding: 8px;
      }
    }
  </style>
</head>
<body>
  <!-- Botón para móviles -->
  <button class="menu-toggle" id="menuToggle" style="display: none;">
    <i class="fas fa-bars"></i>
  </button>

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
      
      // Mostrar/ocultar sidebar en móviles
      if (window.innerWidth <= 992) {
        menuToggle.style.display = 'block';
        sidebar.style.transform = 'translateX(-100%)';
        
        menuToggle.addEventListener('click', () => {
          sidebar.classList.toggle('active');
        });

        // Cerrar sidebar al hacer clic en un enlace
        document.querySelectorAll('.sidebar a').forEach(item => {
          item.addEventListener('click', () => {
            sidebar.classList.remove('active');
          });
        });
      }

      // Redimensionar
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