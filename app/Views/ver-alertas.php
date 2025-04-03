<?php
    $session = session();
    $rol = $session->get("ID_Rol");

    // Verificar si la sesión está iniciada
    if (!isset($session)) {
        $session = session();
    }

    // Verificar si el usuario tiene permiso para entrar a la vista (SOLO ADMIN y SUPERVISOR)
    if ($session->get("ID_Rol") != 5 && $session->get("ID_Rol") != 6) {
        echo "No tienes permiso para entrar en esta vista";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Alertas</title>
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

    /* Contenedor de alertas */
    .alertas-container {
        max-width: 800px;
        margin: 30px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .alertas-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .alertas-header h1 {
        color: #3498db;
        font-size: 24px;
        margin: 0;
    }

    .alertas-list {
        list-style: none;
    }

    .alerta-item {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        transition: background-color 0.3s;
    }

    .alerta-item:hover {
        background-color: #f9f9f9;
    }

    .alerta-item:last-child {
        border-bottom: none;
    }

    .alerta-content {
        display: flex;
        align-items: center;
    }

    .alerta-icon {
        margin-right: 15px;
        color: #e74c3c;
        font-size: 20px;
    }

    .alerta-text {
        flex: 1;
    }

    .alerta-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .alerta-details {
        display: flex;
        justify-content: space-between;
        color: #777;
        font-size: 14px;
    }

    .alerta-time {
        color: #95a5a6;
    }

    .no-alertas {
        padding: 30px;
        text-align: center;
        color: #95a5a6;
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
        
        .alertas-container {
            margin: 20px;
        }
    }

    @media (max-width: 768px) {
        .alertas-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .alertas-header h1 {
            margin-bottom: 10px;
        }
        
        .alerta-details {
            flex-direction: column;
        }
        
        .alerta-time {
            margin-top: 5px;
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
        
        .alerta-item {
            padding: 12px 15px;
        }
        
        .alerta-icon {
            font-size: 18px;
            margin-right: 10px;
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
    <a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item">
      <i class="fas fa-search"></i> Consultar Estado
    </a>
    
    <?php if ($rol == 5 || $rol == 6): ?>
    <div class="menu-heading">Reportes</div>
    <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item active">
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
    <div class="alertas-container">
      <div class="alertas-header">
        <h1>Alertas del Sistema</h1>
      </div>
      
      <?php if (isset($alertas) && !empty($alertas)): ?>
        <ul class="alertas-list">
          <?php foreach ($alertas as $alerta): ?>
            <li class="alerta-item">
              <div class="alerta-content">
                <div class="alerta-icon">
                  <i class="fas fa-exclamation-circle"></i>
                </div>
                <div class="alerta-text">
                  <div class="alerta-title"><?= esc($alerta['titulo']); ?></div>
                  <div class="alerta-details">
                    <span><?= esc($alerta['descripcion']); ?></span>
                    <span class="alerta-time"><?= date('d/m/Y H:i', strtotime($alerta['fecha'])); ?></span>
                  </div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <div class="no-alertas">
          <p>No hay alertas registradas en el sistema</p>
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