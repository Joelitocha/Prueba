<?php
    $session = session();
    $rol = $session->get("ID_Rol");
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Consultar Estado de Tarjeta</title>
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f5f5;
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

    /* Sidebar - Versión responsive */
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

    /* Tarjeta de estado */
    .card-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .card-container::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("<?php echo base_url('assets/images/tarjeta_fondo.png'); ?>");
        background-size: cover;
        background-position: center;
        opacity: 0.1;
        z-index: 0;
    }

    .card-container h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #3498db;
        position: relative;
        z-index: 1;
        text-align: center;
    }

    /* Estilos para los detalles de la tarjeta */
    .card-details {
        margin-top: 20px;
        text-align: left;
        position: relative;
        z-index: 1;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        align-items: center;
    }

    .detail-label {
        font-weight: bold;
        color: #555;
        flex: 1;
    }

    .detail-value {
        flex: 1;
        text-align: right;
        color: #333;
    }

    /* Estilos para estados */
    .status-active {
        color: #27ae60;
        background-color: rgba(39, 174, 96, 0.1);
        padding: 8px 12px;
        border-radius: 4px;
    }

    .status-inactive {
        color: #e74c3c;
        background-color: rgba(231, 76, 60, 0.1);
        padding: 8px 12px;
        border-radius: 4px;
    }

    .status-error {
        color: #e74c3c;
        background-color: rgba(231, 76, 60, 0.1);
        border: 1px solid #e74c3c;
        padding: 15px;
        border-radius: 6px;
        text-align: center;
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
        
        .content, .mensaje {
            margin-left: 0;
        }
        
        .menu-toggle {
            display: block;
        }
        
        .card-container {
            margin: 30px auto;
        }
    }

    @media (max-width: 768px) {
        .card-container {
            margin: 20px;
            padding: 20px;
        }
        
        .card-container h1 {
            font-size: 22px;
        }
        
        .detail-row {
            flex-direction: column;
            align-items: flex-start;
            padding: 10px 0;
        }
        
        .detail-value {
            text-align: left;
            margin-top: 5px;
            width: 100%;
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
        
        .mensaje {
            margin: 15px 10px;
            font-size: 14px;
        }
        
        .card-container {
            padding: 15px;
        }
        
        .detail-row {
            padding: 8px 0;
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
      <div class="menu-heading">Menu</div>
      <a href="<?php echo site_url('/bienvenido');?>" class="menu-item">
        <i class="fas fa-home"></i> Inicio
      </a>
      
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Usuarios</div>
      <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item">
        <i class="fas fa-user-edit"></i> Gestor de Usuarios
      </a>
      <?php endif; ?>
      
      <div class="menu-heading">Tarjetas</div>
      <?php if ($rol == 5): ?>
      <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item">
        <i class="fas fa-credit-card"></i> Gestor de Tarjetas
      </a>
      <?php endif; ?>
      <a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item active">
        <i class="fas fa-search"></i> Consultar Estado
      </a>
      
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
    <div class="card-container">
        <h1>Información de Tarjeta RFID</h1>
        <?php if (isset($tarjeta)): ?>
            <div class="card-details">
                <div class="detail-row">
                    <span class="detail-label">ID:</span>
                    <span class="detail-value"><?= esc($tarjeta['id']) ?></span>
                </div>
                <div class="detail-row <?= $tarjeta['estado'] == 'Activa' ? 'status-active' : 'status-inactive' ?>">
                    <span class="detail-label">Estado:</span>
                    <span class="detail-value"><?= $tarjeta['estado'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fecha Emisión:</span>
                    <span class="detail-value"><?= $tarjeta['fecha_emision'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fecha Expiración:</span>
                    <span class="detail-value"><?= $tarjeta['fecha_expiracion'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Intentos Fallidos:</span>
                    <span class="detail-value"><?= $tarjeta['intentos_fallidos'] ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Horario Uso:</span>
                    <span class="detail-value"><?= $tarjeta['horario_uso'] ?></span>
                </div>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="card-status status-error">
                <?= $error ?>
            </div>
        <?php endif; ?>
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
  </body>
</html>