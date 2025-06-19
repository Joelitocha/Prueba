<?php
    $session = session();
    $rol = $session->get("ID_Rol");
?>

<!doctype html>
<html lang="es">
  <head>
    <title>Inicio</title>
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

      /* Tarjeta de bienvenida */
      .welcome-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        max-width: 900px;
        margin: 30px auto;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        text-align: center;
      }

      .welcome-header h1 {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
      }

      .welcome-message p {
        font-size: 16px;
        color: #555;
        line-height: 1.7;
        margin-bottom: 30px;
      }

      /* Grid de iconos */
      .icon-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
        margin-top: 30px;
      }

      .icon-item {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      }

      .icon-item i {
        font-size: 24px;
        color: #3498db;
        margin-bottom: 10px;
      }

      .icon-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }

      /* Mensajes de error/éxito */
      .mensaje {
        padding: 12px 15px;
        margin: 15px 20px 15px 270px;
        border-radius: 4px;
        text-align: center;
        font-size: 15px;
        transition: margin-left 0.3s ease;
      }

      .error {
        color: #e74c3c;
        background-color: #fdecea;
        border: 1px solid #f5c6cb;
      }

      .success {
        color: #27ae60;
        background-color: #e8f5e9;
        border: 1px solid #c3e6cb;
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

        .mensaje {
          margin: 15px 20px;
        }

        .icon-grid {
          grid-template-columns: repeat(3, 1fr);
        }
      }

      @media (max-width: 768px) {
        .welcome-container {
          padding: 30px;
          margin: 20px auto;
        }
        
        .welcome-header h1 {
          font-size: 26px;
        }
        
        .welcome-message p {
          font-size: 15px;
        }

        .icon-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        .sidebar a {
          padding: 10px 15px;
          font-size: 14px;
        }
        
        .sidebar .logo {
          font-size: 20px;
        }
        
        .welcome-container {
          padding: 20px;
          margin: 15px;
        }
        
        .welcome-header h1 {
          font-size: 22px;
        }

        .icon-grid {
          grid-template-columns: 1fr;
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

      <a href="<?php echo site_url('/bienvenido');?>" class="menu-item active">
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
      <a href="<?php echo site_url('/dispositivo');?>" class="menu-item">
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
      <div class="welcome-container">
        <div class="welcome-header">
          <h1>Bienvenido/a al Sistema</h1>
        </div>
        <div class="welcome-message">
          <?php 
          if ($rol == 5) {
              echo "<p>Hola Administrador, bienvenido. Aquí podrás gestionar usuarios, tarjetas y revisar reportes para asegurar que todo esté en orden. ¡Gracias por mantener el sistema funcionando de manera eficiente!</p>";
          } elseif ($rol == 6) {
              echo "<p>Hola Supervisor, bienvenido/a. En esta sección podrás monitorear el estado de las tarjetas, revisar alertas y accesos. ¡Gracias por asegurarte de que todo esté bajo control!</p>";
          } elseif ($rol == 7) {
              echo "<p>Hola Usuario, bienvenido/a. Aquí puedes consultar el estado de tus tarjetas y asegurarte de que todo está en orden. ¡Gracias por usar nuestro sistema!</p>";
          }
          ?>
        </div>
        
        <div class="icon-grid">
          <div class="icon-item">
            <i class="fas fa-user-shield"></i>
            <p>Seguridad</p>
          </div>
          <div class="icon-item">
            <i class="fas fa-chart-line"></i>
            <p>Estadísticas</p>
          </div>
          <div class="icon-item">
            <i class="fas fa-cog"></i>
            <p>Configuración</p>
          </div>
          <div class="icon-item">
            <i class="fas fa-bell"></i>
            <p>Notificaciones</p>
          </div>
          <div class="icon-item">
            <i class="fas fa-question-circle"></i>
            <p>Ayuda</p>
          </div>
        </div>
      </div>
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