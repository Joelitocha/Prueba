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
        background-color: #f8f9fa; /* Color de fondo general */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
      }

      /* Botón para mostrar/ocultar menú en móviles */
      .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        background-color: #2c3e50; /* Color de fondo del sidebar */
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
        background-color: #2c3e50; /* Color de fondo del sidebar */
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
        color: #ecf0f1; /* Color de texto para ítems del menú */
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
        background-color: #34495e; /* Color de fondo al pasar el mouse */
        transform: translateX(5px);
      }

      /* Efecto para íconos */
      .sidebar a i {
        margin-right: 12px;
        font-size: 16px;
        color: #3498db; /* Color de los íconos */
        transition: all 0.3s ease;
        width: 20px;
        text-align: center;
      }

      .sidebar a:hover i {
        color: #ecf0f1;
      }

      /* Elemento activo */
      .sidebar a.active {
        background-color: #3498db; /* Color de fondo para el ítem activo */
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

      /* Contenedor principal de la tabla (adaptado para alertas) */
      .admin-container { /* Usamos esta clase para el contenedor principal de la vista */
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
      }

      .admin-header { /* Encabezado dentro del contenedor principal */
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
      }

      .admin-header h1 {
        font-size: 24px;
        color: #2c3e50;
        margin: 0;
      }

      /* Estilos específicos de las alertas */
      .alertas-list {
        list-style: none;
        padding: 0; /* Asegurarse de que no haya padding de lista */
        margin: 0;
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
        align-items: flex-start; /* Alinea ícono y texto arriba */
      }

      .alerta-icon {
        margin-right: 15px;
        color: #e74c3c; /* Color para ícono de alerta */
        font-size: 24px; /* Tamaño del ícono */
      }

      .alerta-text {
        flex: 1;
      }

      .alerta-title {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 16px;
      }

      .alerta-details {
        display: flex;
        justify-content: space-between;
        color: #777;
        font-size: 14px;
        flex-wrap: wrap; /* Para responsive */
      }

      .alerta-time {
        color: #95a5a6;
      }

      .no-alertas {
        padding: 30px;
        text-align: center;
        color: #95a5a6;
        font-size: 16px;
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
          padding: 20px;
        }
        
        .menu-toggle {
          display: block;
        }
        
        .admin-container {
          margin: 20px;
          padding: 20px;
        }

        .admin-header {
          flex-direction: column;
          align-items: flex-start;
          gap: 10px;
        }
      }

      @media (max-width: 768px) {
        .alerta-details {
          flex-direction: column;
          align-items: flex-start;
          gap: 5px;
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        .sidebar a {
          padding: 10px 12px;
          font-size: 14px;
        }
        
        .sidebar .logo {
          font-size: 20px;
        }
        
        .mensaje {
          margin: 15px 10px;
          font-size: 14px;
        }
        
        .alerta-item {
          padding: 12px 15px;
        }
        
        .alerta-icon {
          font-size: 20px;
          margin-right: 10px;
        }
        .alerta-title {
          font-size: 15px;
        }
        .alerta-details {
          font-size: 13px;
        }
        .admin-header h1 {
          font-size: 20px;
        }
        .alerta-filtros {
          margin-bottom: 20px;
          display: flex;
          flex-wrap: wrap;
          gap: 10px;
        }

        .filtro-btn {
            padding: 8px 15px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .filtro-btn:hover {
            background-color: #2980b9;
        }

        .filtro-btn.active {
            background-color: #2ecc71;
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
      <a href="<?php echo site_url('/dispositivo');?>" class="menu-item">
      <i class="fas fa-network-wired"></i> Gestionar Dispositivos
      </a>
      <?php endif; ?>

      <!-- Opciones para Supervisor y Administrador -->
      <?php if ($rol == 5 || $rol == 6): ?>
      <div class="menu-heading">Reportes</div>
      <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item active">
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
        <div class="admin-container">
            <div class="admin-header">
            <div class="alerta-filtros">
              <button class="filtro-btn active" data-tipo="todas">Todas</button>
              <button class="filtro-btn" data-tipo="hardware">Hardware</button>
              <button class="filtro-btn" data-tipo="software">Software</button>
              <button class="filtro-btn" data-tipo="acceso">Acceso</button>
              <button class="filtro-btn" data-tipo="sistema">Sistema</button>
            </div>
                <h1>Alertas del Sistema</h1>
            </div>
            
            <?php if (isset($alertas) && !empty($alertas)): ?>
                <ul class="alertas-list">
                    <?php foreach ($alertas as $alerta): ?>
                      <li class="alerta-item" data-tipo="<?= esc($alerta['tipo']); ?>">
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
      const botonesFiltro = document.querySelectorAll('.filtro-btn');
const alertasItems = document.querySelectorAll('.alerta-item');

botonesFiltro.forEach(boton => {
    boton.addEventListener('click', () => {
        // Removemos la clase active de todos los botones
        botonesFiltro.forEach(b => b.classList.remove('active'));
        // Activamos el que se clickeó
        boton.classList.add('active');

        const tipoSeleccionado = boton.getAttribute('data-tipo');

        alertasItems.forEach(item => {
            if (tipoSeleccionado === 'todas' || item.getAttribute('data-tipo') === tipoSeleccionado) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

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
</body>
</html>
