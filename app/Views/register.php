<?php
    $session = session();
    $rol = $session->get("ID_Rol");
    
    // Verificar si el usuario tiene permiso para entrar a la vista (SOLO ADMIN)
    if ($rol != 5) {
        echo "No tienes permiso para entrar en esta vista";
        exit;
    }
?>

<!doctype html>
<html lang="es">
  <head>
    <title>Crear Usuario</title>
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

      /* Estilos del formulario de registro */
      .registro-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        max-width: 600px;
        margin: 30px auto;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
      }

      .registro-header h1 {
        font-size: 24px;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
        text-align: center;
      }

      .registro-form input[type="text"],
      .registro-form input[type="email"],
      .registro-form input[type="password"],
      .registro-form select {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s ease;
      }

      .registro-form input:focus,
      .registro-form select:focus {
        border-color: #3498db;
        outline: none;
      }

      .registro-form label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-size: 14px;
      }

      .registro-form button[type="submit"] {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
        margin-top: 10px;
      }

      .registro-form button[type="submit"]:hover {
        background-color: #2980b9;
      }

      .volver-btn {
        display: inline-block;
        margin-top: 15px;
        color: #3498db;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
      }

      .volver-btn:hover {
        color: #1a5a85;
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

      /* Flash Card */
      .flash-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 500px;
        margin: 20px auto;
        animation: fadeIn 0.5s ease-out;
      }

      .flash-header h1 {
        font-size: 22px;
        color: #27ae60;
        margin-bottom: 10px;
        text-align: center;
      }

      .flash-message p {
        font-size: 15px;
        color: #333;
        text-align: center;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(-10px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
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
        .registro-container {
          padding: 30px;
          margin: 20px auto;
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        .registro-container {
          padding: 20px;
          margin: 15px;
        }
        
        .registro-header h1 {
          font-size: 22px;
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
      <!-- Opciones para el Perfil -->
      <div class="menu-heading">Perfil</div>
      <a href="<?php echo site_url('/mi-usuario');?>" class="menu-item">
        <i class="fas fa-users-cog"></i> Mis Datos
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
      <div class="registro-container">
        <div class="registro-header">
          <h1>Crear Nuevo Usuario</h1>
        </div>
        
        <form action="<?php echo site_url('/register2') ?>" method="POST" class="registro-form">
          <label for="Nombre">Nombre Completo</label>
          <input type="text" placeholder="Nombre Completo" name="Nombre" id="Nombre" required>
          
          <label for="Email">Correo Electrónico</label>
          <input type="email" placeholder="Correo Electrónico" name="Email" id="Email" required>
          
          <label for="ID_Tarjeta">Seleccionar Tarjeta:</label>
          <select name="ID_Tarjeta" id="ID_Tarjeta" required>
            <option value="">Seleccione una tarjeta</option>
            <?php foreach ($tarjetas as $tarjeta): ?>
              <option value="<?= $tarjeta['ID_Tarjeta']; ?>">
                Tarjeta <?= $tarjeta['ID_Tarjeta']; ?>
              </option>
            <?php endforeach; ?>
          </select>
          
          <label for="ID_Rol">Seleccionar Rol:</label>
          <select name="ID_Rol" id="ID_Rol" required>
            <option value="5">Administrador</option>
            <option value="6">Supervisor</option>
            <option value="7">Usuario</option>
          </select>

          <div class="horarios-container">
            <?php 
              $dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
              foreach ($dias as $dia): ?>
                <div class="horario-dia">
                  <label><?php echo $dia; ?></label>
                  <input type="time" name="horario_uso[<?php echo strtolower($dia); ?>][inicio]" value="09:00">
                  <input type="time" name="horario_uso[<?php echo strtolower($dia); ?>][fin]" value="18:00">
                </div>
              <?php endforeach; ?>
          </div>
          
          <button type="submit">Registrar Usuario</button>
          <a href="<?php echo site_url('/modificar-usuario'); ?>" class="volver-btn">
            <i class="fas fa-arrow-left"></i> Volver
          </a>
        </form>
      </div>
      
      <?php
        $success = session()->getFlashdata("success");
        if ($success) {
            echo '
            <div class="flash-card">
                <div class="flash-header">
                    <h1>Operación Exitosa</h1>
                </div>
                <div class="flash-message">
                    <p>'.$success.'</p>
                </div>
            </div>';
        }
      ?>
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
      }
    ?>
  </body>
</html>