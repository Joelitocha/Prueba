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

      /* Carrusel principal */
      .carousel-container {
        background-color: #fff;
        border-radius: 10px;
        max-width: 1000px;
        margin: 30px auto;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
        min-height: 500px;
      }

      /* Slides del carrusel */
      .carousel-slide {
        padding: 40px;
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease;
        min-height: 500px;
      }

      .carousel-slide.active {
        display: block;
        opacity: 1;
      }

      /* Slide de bienvenida */
      .welcome-header h1 {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
        text-align: center;
      }

      .welcome-message p {
        font-size: 16px;
        color: #555;
        line-height: 1.7;
        margin-bottom: 30px;
        text-align: center;
      }

      /* Slide de información de empresa */
      .company-info-slide {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
      }

      .company-icon {
        font-size: 48px;
        color: #3498db;
        margin-bottom: 30px;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .company-title {
        font-size: 28px;
        color: #2c3e50;
        margin-bottom: 40px;
        font-weight: 600;
      }

      .company-details {
        display: grid;
        grid-template-columns: 1fr;
        gap: 25px;
        max-width: 400px;
        width: 100%;
      }

      .company-detail-item {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        border-left: 4px solid #3498db;
      }

      .company-detail-label {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 8px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
      }

      .company-detail-value {
        font-size: 18px;
        color: #2c3e50;
        font-weight: 600;
      }

      /* Botones de navegación del carrusel */
      .carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(52, 152, 219, 0.9);
        border: none;
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.3s ease;
        z-index: 100;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      }

      .carousel-nav:hover {
        background: #2980b9;
        transform: translateY(-50%) scale(1.1);
      }

      .carousel-nav.prev {
        left: 20px;
      }

      .carousel-nav.next {
        right: 20px;
      }

      /* Indicadores del carrusel */
      .carousel-indicators {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
      }

      .carousel-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #bdc3c7;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .carousel-indicator.active {
        background: #3498db;
        transform: scale(1.2);
      }

      /* Grid de iconos estilo masonry/ladrillos */
      .masonry-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        grid-auto-rows: 120px;
        grid-gap: 20px;
        margin-top: 30px;
      }

      .masonry-item {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        cursor: pointer;
        text-decoration: none;
        position: relative;
        overflow: hidden;
      }

      /* Variación de alturas para efecto masonry */
      .masonry-item:nth-child(3n+1) {
        grid-row: span 2;
        height: 260px;
      }

      .masonry-item:nth-child(5n+2) {
        grid-row: span 1;
        height: 120px;
      }

      .masonry-item:nth-child(7n+3) {
        grid-row: span 3;
        height: 400px;
      }

      .masonry-item i {
        font-size: 32px;
        margin-bottom: 15px;
        color: #3498db;
        transition: all 0.3s ease;
      }

      .masonry-item p {
        font-size: 15px;
        color: #555;
        text-align: center;
        transition: all 0.3s ease;
      }

      .masonry-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        background-color: #3498db;
      }

      .masonry-item:hover i,
      .masonry-item:hover p {
        color: white;
      }

      /* Efecto de borde inferior al hover */
      .masonry-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: #3498db;
        transform: scaleX(0);
        transition: transform 0.3s ease;
      }

      .masonry-item:hover::after {
        transform: scaleX(1);
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
      @media (max-width: 1200px) {
        .masonry-grid {
          grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
      }

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

        .masonry-grid {
          grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
      }

      @media (max-width: 768px) {
        .carousel-container {
          margin: 20px auto;
          min-height: 400px;
        }

        .carousel-slide {
          padding: 30px;
          min-height: 400px;
        }

        .welcome-header h1 {
          font-size: 26px;
        }
        
        .welcome-message p {
          font-size: 15px;
        }

        .company-title {
          font-size: 24px;
        }

        .company-detail-value {
          font-size: 16px;
        }

        .carousel-nav {
          width: 40px;
          height: 40px;
          font-size: 16px;
        }

        .masonry-item:nth-child(n) {
          grid-row: span 1;
          height: 120px;
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
        
        .carousel-container {
          margin: 15px;
          min-height: 350px;
        }

        .carousel-slide {
          padding: 20px;
          min-height: 350px;
        }
        
        .welcome-header h1 {
          font-size: 22px;
        }

        .masonry-grid {
          grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
          grid-auto-rows: 100px;
        }

        .masonry-item {
          padding: 15px;
        }

        .masonry-item i {
          font-size: 24px;
          margin-bottom: 10px;
        }

        .masonry-item p {
          font-size: 13px;
        }

        .company-title {
          font-size: 20px;
        }

        .company-detail-item {
          padding: 15px;
        }

        .carousel-nav {
          width: 35px;
          height: 35px;
          font-size: 14px;
        }

        .carousel-nav.prev {
          left: 10px;
        }

        .carousel-nav.next {
          right: 10px;
        }
      }
      /* Responsive para celulares */
@media (max-width: 768px) {
  .sidebar {
    transform: translateX(-100%);
    position: fixed;
    z-index: 1000;
  }

  .sidebar.active {
    transform: translateX(0);
  }

  .menu-toggle {
    display: block;
  }

  .content {
    margin-left: 0;
    padding: 20px;
  }

  .mensaje {
    margin-left: 0;
  }

  .welcome-container {
    margin: 15px 10px;
    padding: 20px;
  }

  .welcome-header h1 {
    font-size: 22px;
  }

  .welcome-message p {
    font-size: 15px;
  }

  .masonry-grid {
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    grid-auto-rows: 100px;
  }

  .masonry-item {
    padding: 10px;
  }

  .masonry-item i {
    font-size: 22px;
  }

  .masonry-item p {
    font-size: 13px;
  }
}
/* Tarjeta de información de la empresa */
.company-card {
  background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
  border: 1px solid #e9ecef;
  border-radius: 12px;
  padding: 25px;
  max-width: 450px;
  margin: 30px auto;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.company-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: linear-gradient(90deg, #3498db, #2c3e50);
}

.company-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.company-header {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 1px solid #e9ecef;
}

.company-header i {
  font-size: 24px;
  color: #3498db;
  margin-right: 12px;
  background: #f8f9fa;
  padding: 10px;
  border-radius: 8px;
}

.company-header h2 {
  margin: 0;
  font-size: 20px;
  color: #2c3e50;
  font-weight: 600;
}

.company-info {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.info-item {
  display: flex;
  flex-direction: column;
  padding: 12px 0;
}

.info-label {
  font-size: 14px;
  color: #6c757d;
  font-weight: 500;
  margin-bottom: 5px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.info-value {
  font-size: 18px;
  color: #2c3e50;
  font-weight: 600;
  padding: 8px 12px;
  background: #f8f9fa;
  border-radius: 6px;
  border-left: 3px solid #3498db;
}

/* Responsive para la tarjeta de empresa */
@media (max-width: 768px) {
  .company-card {
    margin: 20px 15px;
    padding: 20px;
    max-width: none;
  }
  
  .company-header {
    flex-direction: column;
    text-align: center;
    gap: 10px;
  }
  
  .company-header i {
    margin-right: 0;
  }
  
  .info-item {
    text-align: center;
  }
  
  .info-value {
    border-left: none;
    border-top: 3px solid #3498db;
    padding: 10px;
  }
}

@media (max-width: 576px) {
  .company-card {
    padding: 15px;
    margin: 15px 10px;
  }
  
  .company-header h2 {
    font-size: 18px;
  }
  
  .info-label {
    font-size: 13px;
  }
  
  .info-value {
    font-size: 16px;
    padding: 8px;
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
      <!-- Carrusel principal -->
      <div class="carousel-container">
        <!-- Slide de Bienvenida -->
        <div class="carousel-slide active" id="slide-welcome">
          <div class="welcome-header">
            <h1>Bienvenido/a al Sistema</h1>
          </div>
          <div class="welcome-message">
            <?php 
            if ($rol == 5) {
                echo "<p>Hola Administrador, desde aquí puedes acceder a: Gestión de Usuarios - Gestión de Tarjetas - Dispositivos - Alertas del Sistema - Historial Completo - Control de Accesos</p>";
            } elseif ($rol == 6) {
                echo "<p>Hola Supervisor, desde aquí puedes acceder a: Consultar Estado - Alertas Recientes - Registro de Accesos - Historial de Cambios</p>";
            } elseif ($rol == 7) {
                echo "<p>Hola Usuario, desde aquí puedes acceder a: Consultar Estado</p>";
            }
            ?>
          </div>
          
          <div class="masonry-grid">
            <?php if ($rol == 5): ?>
              <!-- Iconos para Administrador -->
              <a href="<?php echo site_url('/modificar-usuario');?>" class="masonry-item">
                <i class="fas fa-users-cog"></i>
                <p>Gestión de Usuarios</p>
              </a>
              <a href="<?php echo site_url('/modificar-tarjeta');?>" class="masonry-item">
                <i class="fas fa-id-card"></i>
                <p>Gestión de Tarjetas</p>
              </a>
              <a href="<?php echo site_url('/consultar-rfid');?>" class="masonry-item">
                <i class="fas fa-money-check"></i>
                <p>Consultar Estado de la Tarjeta</p>
              </a>
              <a href="<?php echo site_url('/dispositivo');?>" class="masonry-item">
                <i class="fas fa-server"></i>
                <p>Dispositivos</p>
              </a>
              <a href="<?php echo site_url('/ver-alertas');?>" class="masonry-item">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Alertas del Sistema</p>
              </a>
              <a href="<?php echo site_url('/historial-cambios');?>" class="masonry-item">
                <i class="fas fa-history"></i>
                <p>Historial Completo</p>
              </a>
              <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="masonry-item">
                <i class="fas fa-door-open"></i>
                <p>Control de Accesos</p>
              </a>
              
            <?php elseif ($rol == 6): ?>
              <!-- Iconos para Supervisor -->
              <a href="<?php echo site_url('/consultar-rfid');?>" class="masonry-item">
                <i class="fas fa-search"></i>
                <p>Consultar Estado</p>
              </a>
              <a href="<?php echo site_url('/ver-alertas');?>" class="masonry-item">
                <i class="fas fa-bell"></i>
                <p>Alertas Recientes</p>
              </a>
              <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="masonry-item">
                <i class="fas fa-door-open"></i>
                <p>Registro de Accesos</p>
              </a>
              <a href="<?php echo site_url('/historial-cambios');?>" class="masonry-item">
                <i class="fas fa-history"></i>
                <p>Historial de Cambios</p>
              </a>

            <?php elseif ($rol == 7): ?>
              <!-- Iconos para Usuario -->
              <a href="<?php echo site_url('/consultar-rfid');?>" class="masonry-item">
                <i class="fas fa-search"></i>
                <p>Consultar Estado</p>
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Slide de Información de la Empresa -->
        <div class="carousel-slide company-info-slide" id="slide-company">
          <div class="company-icon">
            <i class="fas fa-building"></i>
          </div>
          <h2 class="company-title">Información de la Empresa</h2>
          <div class="company-details">
            <div class="company-detail-item">
              <div class="company-detail-label">Nombre de la empresa</div>
              <div class="company-detail-value"><?php echo session()->get('enombre'); ?></div>
            </div>
            <div class="company-detail-item">
              <div class="company-detail-label">Código de la empresa</div>
              <div class="company-detail-value"><?php echo session()->get('ecode'); ?></div>
            </div>
          </div>
        </div>

        <!-- Botones de navegación -->
        <button class="carousel-nav prev" onclick="prevSlide()">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-nav next" onclick="nextSlide()">
          <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Indicadores -->
        <div class="carousel-indicators">
          <div class="carousel-indicator active" onclick="goToSlide(0)"></div>
          <div class="carousel-indicator" onclick="goToSlide(1)"></div>
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

      // Ajustar automáticamente el grid masonry
      function resizeMasonryItem(item){
        const grid = document.querySelector('.masonry-grid');
        const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
        const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        const contentHeight = item.querySelector('.masonry-content').getBoundingClientRect().height;
        const rowSpan = Math.ceil((contentHeight + rowGap) / (rowHeight + rowGap));
        item.style.gridRowEnd = 'span '+rowSpan;
      }

      function resizeAllMasonryItems(){
        const allItems = document.querySelectorAll('.masonry-item');
        allItems.forEach(item => {
          resizeMasonryItem(item);
        });
      }

      // Ejecutar al cargar y al redimensionar
      window.addEventListener('load', resizeAllMasonryItems);
      window.addEventListener('resize', resizeAllMasonryItems);

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

      // Funcionalidad del carrusel
      let currentSlide = 0;
      const slides = document.querySelectorAll('.carousel-slide');
      const indicators = document.querySelectorAll('.carousel-indicator');

      function showSlide(index) {
        // Ocultar todos los slides
        slides.forEach(slide => {
          slide.classList.remove('active');
        });
        
        // Remover active de todos los indicadores
        indicators.forEach(indicator => {
          indicator.classList.remove('active');
        });
        
        // Mostrar slide actual y activar indicador
        slides[index].classList.add('active');
        indicators[index].classList.add('active');
        
        currentSlide = index;
      }

      function nextSlide() {
        let next = currentSlide + 1;
        if (next >= slides.length) {
          next = 0;
        }
        showSlide(next);
      }

      function prevSlide() {
        let prev = currentSlide - 1;
        if (prev < 0) {
          prev = slides.length - 1;
        }
        showSlide(prev);
      }

      function goToSlide(index) {
        showSlide(index);
      }

      // Navegación con teclado
      document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
          prevSlide();
        } else if (e.key === 'ArrowRight') {
          nextSlide();
        }
      });

      // Ajustar automáticamente el grid masonry
      function resizeMasonryItem(item){
        const grid = document.querySelector('.masonry-grid');
        const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
        const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        const contentHeight = item.querySelector('.masonry-content').getBoundingClientRect().height;
        const rowSpan = Math.ceil((contentHeight + rowGap) / (rowHeight + rowGap));
        item.style.gridRowEnd = 'span '+rowSpan;
      }

      function resizeAllMasonryItems(){
        const allItems = document.querySelectorAll('.masonry-item');
        allItems.forEach(item => {
          resizeMasonryItem(item);
        });
      }

      // Ejecutar al cargar y al redimensionar
      window.addEventListener('load', resizeAllMasonryItems);
      window.addEventListener('resize', resizeAllMasonryItems);
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