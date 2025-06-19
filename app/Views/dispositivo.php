<?php
$session = session();
$rol = $session->get("ID_Rol");
?>

<?php if ($rol != 5): ?>
  <p>No tenés permiso para ver esta página, mostro.</p>
  <?php return; ?>
<?php endif; ?>

<!doctype html>
<html lang="es">
  <head>
    <title>Dispositivos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      /* Estilos generales */
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
      
      body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
      }

      /* Botón para mostrar/ocultar menú en móviles */
      .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 15px;
        z-index: 1100;
        cursor: pointer;
        font-size: 18px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      }

      /* Estilos para el Sidebar - Versión responsive */
      .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #2c3e50;
        padding-top: 20px;
        color: #fff;
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        scrollbar-width: none;
        z-index: 1000;
        transition: transform 0.3s ease;
      }

      .sidebar::-webkit-scrollbar {
        display: none;
      }

      .sidebar a {
        padding: 12px 20px;
        text-decoration: none;
        font-size: 15px;
        color: #ecf0f1;
        display: flex;
        align-items: center;
        margin: 5px 10px;
        border-radius: 4px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      /* Efecto hover */
      .sidebar a:hover {
        background-color: #34495e;
        transform: translateX(5px);
      }

      /* Efecto para íconos */
      .sidebar a i {
        margin-right: 12px;
        font-size: 16px;
        color: #3498db;
        transition: all 0.3s ease;
        width: 20px;
        text-align: center;
      }

      .sidebar a:hover i {
        color: #ecf0f1;
      }

      /* Elemento activo */
      .sidebar a.active {
        background-color: #3498db;
        color: white;
      }

      .sidebar a.active i {
        color: white;
      }

      .sidebar .logo {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #ecf0f1;
        padding: 0 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .sidebar .logo .role {
        font-size: 14px;
        margin-top: 5px;
        color: #bdc3c7;
        font-weight: normal;
      }

      .sidebar .menu-heading {
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: bold;
        margin-top: 20px;
        font-size: 12px;
        color: #bdc3c7;
        letter-spacing: 1px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
      }

      /* Contenido principal */
      .content {
        margin-left: 250px;
        padding: 30px;
        transition: margin-left 0.3s ease;
        min-height: 100vh;
      }

      /* Estilos específicos para dispositivos */
      h1 {
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
      }

      th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        text-align: left;
      }

      th {
        background-color: #3498db;
        color: white;
        font-weight: 500;
      }

      tr:hover {
        background-color: #f8f9fa;
      }

      .btn-action {
        display: inline-flex;
        align-items: center;
        color: white;
        padding: 8px 15px;
        border: none;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s ease;
        margin-right: 8px;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
        margin-top: 10px;
        display: inline-flex;
      }

      .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        opacity: 0.9;
      }

      .btn-action i {
        margin-right: 8px;
        font-size: 14px;
      }

      /* Mensajes */
      .no-devices {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
      }

      /* Media Queries para responsive */
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
          padding: 10px;
          font-size: 14px;
        }

        .btn-action {
          padding: 6px 10px;
          font-size: 13px;
          margin-right: 5px;
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        table {
          display: block;
          overflow-x: auto;
        }
        
        .btn-action {
          margin-bottom: 5px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Botón para mostrar/ocultar menú en móviles -->
    <button class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars"></i> Menú
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="logo">
        <?php 
          if ($rol == 5) {
              echo "Panel de Control";
              echo '<span class="role">Administrador</span>';
          } elseif ($rol == 6) {
              echo "Panel Supervisor";
              echo '<span class="role">Supervisor</span>';
          } elseif ($rol == 7) {
              echo "Bienvenido";
              echo '<span class="role">Usuario</span>';
          }
        ?>
      </div>

      <a href="<?php echo site_url('/bienvenido');?>" class="menu-item">
        <i class="fas fa-home"></i> Inicio
      </a>
      
      <!-- Opciones para Administrador -->
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Administración</div>
      <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item">
        <i class="fas fa-users-cog"></i> Gestión de Usuarios
      </a>
      <?php endif; ?>
      
      <!-- Opciones para Tarjetas -->
      <div class="menu-heading">Tarjetas RFID</div>
      <?php if ($rol == 5): ?>
      <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item">
        <i class="fas fa-credit-card"></i> Gestión de Tarjetas
      </a>
      <?php endif; ?>
      <a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item">
        <i class="fas fa-search"></i> Consultar Estado
      </a>
      
      <!-- Opciones para Dispositivos -->
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Dispositivos</div>
      <a href="<?php echo site_url('/dispositivo');?>" class="menu-item active">
      <i class="fas fa-network-wired"></i> Gestionar Dispositivos
      </a>
      <?php endif; ?>

      <!-- Opciones para Supervisor y Administrador -->
      <?php if ($rol == 5 || $rol == 6): ?>
      <div class="menu-heading">Reportes</div>
      <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item">
        <i class="fas fa-bell"></i> Alertas
      </a>
      <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item">
        <i class="fas fa-door-open"></i> Accesos
      </a>
      <a href="<?php echo site_url('/historial-cambios');?>" class="menu-item">
        <i class="fas fa-history"></i> Historial
      </a>
      <?php endif; ?>
      
      <div class="menu-heading">Cuenta</div>
      <a onclick="cerrarsesion('<?php echo site_url('/logout');?>')" class="menu-item">
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
        <div class="no-devices">
          <p>No hay dispositivos registrados todavía.</p>
        </div>
      <?php endif; ?>

      <a class="btn-action btn-add" href="<?= site_url('configurar-dispositivo') ?>">
        <i class="fas fa-plus"></i> Agregar Dispositivo
      </a>
    </div>

    <script>
      // Mostrar/ocultar sidebar en móviles
      const menuToggle = document.getElementById('menuToggle');
      const sidebar = document.getElementById('sidebar');
      
      menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
      });

      // Cerrar sidebar al hacer clic en un enlace (en móviles)
      const menuItems = document.querySelectorAll('.sidebar a');
      menuItems.forEach(item => {
        item.addEventListener('click', () => {
          if (window.innerWidth <= 992) {
            sidebar.classList.remove('active');
          }
        });
      });

      // Cerrar sesión
      function cerrarsesion(url){
        if(confirm('¿Estás seguro de que deseas cerrar sesión?')){
          window.location.href=url;
        }
      }

      // Redimensionar la ventana
      window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
          sidebar.classList.remove('active');
        }
      });
    </script>

    <?php
      if (isset($error)) {
        echo '<div class="mensaje error">'.$error.'</div>';
      } elseif (isset($success)) {
        echo '<div class="mensaje success">'.$success.'</div>';
      }
    ?>
  </body>
</html>