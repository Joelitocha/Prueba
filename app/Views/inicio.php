<?php
    $session = session();
    $rol = $session->get("ID_Rol");
?>

<!doctype html>
<html lang="en">
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
        background-color: #f5f5f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
      }

      /* Botón para mostrar/ocultar menú en móviles */
      .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px;
        z-index: 1100;
        cursor: pointer;
        font-size: 18px;
      }

      /* Estilos para el Sidebar - Versión responsive */
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

      /* Efecto hover */
      .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 15px rgba(52, 152, 219, 0.3);
      }

      /* Efecto para íconos */
      .sidebar a i {
        margin-right: 10px;
        font-size: 18px;
        color: #3498db;
        transition: transform 0.3s ease;
      }

      .sidebar a:hover i {
        transform: scale(1.15);
      }

      /* Elemento activo */
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
        padding: 20px;
        transition: margin-left 0.3s ease;
      }

      /* Tarjeta de bienvenida */
      .welcome-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        max-width: 800px;
        margin: 50px auto;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
      }

      .welcome-card {
        text-align: center;
      }

      .welcome-header h1 {
        font-size: 28px;
        color: #3498db;
        margin-bottom: 20px;
      }

      .welcome-message p {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
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
      }

      @media (max-width: 768px) {
        .welcome-container {
          padding: 20px;
          margin: 30px auto;
        }
        
        .welcome-header h1 {
          font-size: 24px;
        }
        
        .welcome-message p {
          font-size: 15px;
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        .sidebar a {
          padding: 10px 12px;
          font-size: 15px;
        }
        
        .sidebar .logo {
          font-size: 22px;
        }
        
        .welcome-container {
          padding: 15px;
          margin: 20px 10px;
        }
        
        .welcome-header h1 {
          font-size: 22px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Botón para mostrar/ocultar menú en móviles -->
    <button class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="logo">
        <?php 
          if ($rol == 5) {
              echo "Administrador";
          } elseif ($rol == 6) {
              echo "Supervisor";
          } elseif ($rol == 7) {
              echo "Usuario";
          }
        ?>
      </div>

      <a href="<?php echo site_url('/bienvenido');?>" class="menu-item active">
        <i class="fas fa-home"></i> Inicio
      </a>
      
      <!-- Opciones para Administrador -->
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Usuarios</div>
      <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item">
        <i class="fas fa-user-edit"></i> Gestor de Usuarios
      </a>
      <?php endif; ?>
      
      <!-- Opciones para Tarjetas -->
      <div class="menu-heading">Tarjetas</div>
      <?php if ($rol == 5): ?>
      <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item">
        <i class="fas fa-credit-card"></i> Gestor de Tarjetas
      </a>
      <?php endif; ?>
      <a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item">
        <i class="fas fa-search"></i> Consultar Estado
      </a>
      
      <!-- Opciones para Dispositivos -->
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Dispositivos</div>
      <a href="<?php echo site_url('/dispositivo');?>" class="menu-item">
      <i class="fas fa-microchip"></i> Gestionar Dispositivos
      </a>
      <?php endif; ?>

      <!-- Opciones para Supervisor y Administrador -->
      <?php if ($rol == 5 || $rol == 6): ?>
      <div class="menu-heading">Reportes</div>
      <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item">
        <i class="fas fa-exclamation-triangle"></i> Ver Alertas
      </a>
      <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item">
        <i class="fas fa-key"></i> Ver Accesos
      </a>
      <a href="<?php echo site_url('/historial-cambios');?>" class="menu-item">
        <i class="fas fa-history"></i> Historial
      </a>
      <?php endif; ?>
      
      <div class="menu-heading">Sesión</div>
      <a onclick="cerrarsesion('<?php echo site_url('/logout');?>')" class="menu-item">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
      </a>
    </div>

    <!-- Contenido principal -->
    <div class="content">
      <div class="welcome-container">
        <div class="welcome-card">
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
        if(confirm('¿Seguro Queres Cerrar Sesion?')){
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