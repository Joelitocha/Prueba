<?php
    $session = session();
    $rol = $session->get("ID_Rol");

    // Verificar si la sesión está iniciada
    if (!isset($session)) {
        $session = session();
    }

    // Verificar si el usuario tiene permiso para entrar a la vista (SOLO ADMIN)
    if ($session->get("ID_Rol") != 5) {
        echo "No tienes permiso para entrar en esta vista";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Tarjeta</title>
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

    /* Formulario de modificación */
    .form-container {
        max-width: 500px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        color: #3498db;
        margin-bottom: 25px;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #3498db;
        outline: none;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background-color: #2980b9;
    }

    .btn-volver {
        display: inline-block;
        width: 100%;
        padding: 10px;
        text-align: center;
        background-color: #95a5a6;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-top: 15px;
        text-decoration: none;
    }

    .btn-volver:hover {
        background-color: #7f8c8d;
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
        
        .form-container {
            margin: 30px auto;
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .form-container {
            margin: 20px;
            width: auto;
        }
        
        .form-container h1 {
            font-size: 22px;
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
        
        .form-container {
            padding: 15px;
        }
        
        .form-group input,
        .form-group select {
            padding: 10px 12px;
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
    <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item active">
      <i class="fas fa-credit-card"></i> Gestor de Tarjetas
    </a>
    <?php endif; ?>
    <a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item">
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
  <div class="form-container">
      <h1>Modificar Tarjeta <?= esc($tarjeta['ID_Tarjeta']); ?></h1>
      <form action="<?= site_url('actualizar-tarjeta') ?>" method="post">
          <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">
          
          <div class="form-group">
                <label for="fecha_expiracion">Fecha de Expiración</label>
                <input type="date" name="fecha_expiracion" id="fecha_expiracion" value="<?= !empty($tarjeta['Fecha_Expiracion']) ? esc($tarjeta['Fecha_Expiracion']) : '' ?>">
                <small class="form-text text-muted">Dejar vacío para tarjeta sin expiración</small>
          </div>      
          
          <div class="form-group">
            <label for="horario_uso">Horario de Uso</label>
            <input type="text" name="horario_uso" id="horario_uso" value="<?= !empty($tarjeta['Horario_Uso']) ? esc($tarjeta['Horario_Uso']) : '' ?>"placeholder="Ej: 08:00-18:00 o L-V:08:00-18:00,S-D:10:00-15:00">
            <small class="form-text text-muted">Dejar vacío para tarjeta sin restricción horaria</small>
          </div>
          
          <div class="form-group">
              <label for="bloqueada">Estado de Bloqueo</label>
              <select name="bloqueada" id="bloqueada">
                <option value="0" <?= $tarjeta['Estado'] == 0 ? 'selected' : '' ?>>Desbloqueada</option>
                <option value="1" <?= $tarjeta['Estado'] == 1 ? 'selected' : '' ?>>Bloqueada</option>
              </select>
          </div>
          
          <div class="form-group">
              <label for="intentos_fallidos">Intentos Fallidos</label>
              <input type="number" name="intentos_fallidos" id="intentos_fallidos" 
                     value="<?= esc($tarjeta['Intentos_Fallidos'] ?? 0); ?>" min="0" max="3">
              <small class="form-text text-muted">Máximo 3 intentos antes de bloqueo automático</small>
          </div>

          <button type="submit" class="btn-submit">Actualizar Tarjeta</button>
          <a href="<?= site_url('modificar-tarjeta') ?>" class="btn-volver">Volver</a>
      </form>
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