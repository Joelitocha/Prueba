<?php
    $session = session();
    $rol = $session->get("ID_Rol");

    // Verificar permisos (solo admin)
    if ($session->get("ID_Rol") != 5) {
        echo "No tienes permiso para entrar en esta vista";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    /* === ESTILOS GENERALES === */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        min-height: 100vh;
    }

    /* === SIDEBAR (Mismo estilo que el primer archivo) === */
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

    /* === FORMULARIO (Estilo adaptado del primer archivo) === */
    .content {
        margin-left: 250px;
        padding: 20px;
        transition: margin-left 0.3s ease;
    }

    .form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 600px;
        margin: 30px auto;
    }

    .form-container h1 {
        color: #2c3e50;
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #7f8c8d;
        font-weight: 500;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 15px;
        transition: border 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #3498db;
        outline: none;
    }

    .btn-submit {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 100%;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background-color: #2980b9;
    }

    .btn-back {
        display: inline-block;
        margin-top: 15px;
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
        text-align: center;
        width: 100%;
    }

    .btn-back:hover {
        color: #2c3e50;
    }

    /* === MENSAJES === */
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

    /* === RESPONSIVE === */
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
    }

    @media (max-width: 768px) {
        .form-container {
            padding: 20px;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            width: 220px;
        }
        
        .form-container {
            margin: 20px 10px;
        }
    }
    </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
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
    <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item active">
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
      <h1>Modificar Usuario</h1>
      <form action="<?php echo site_url('/actualizar-usuario') ?>" method="post">
        <div class="form-group">
          <label for="Nombre">Nombre de Usuario</label>
          <input type="text" name="Nombre" id="Nombre" value="<?= esc($user[0]['Nombre']) ?>" required maxlength="50">
        </div>
        
        <div class="form-group">
          <label for="Email">Correo Electrónico</label>
          <input type="email" name="Email" id="Email" value="<?= esc($user[0]['Email']) ?>" required maxlength="100">
        </div>
        
        <div class="form-group">
          <label for="ID_Rol">Rol</label>
          <select name="ID_Rol" id="ID_Rol" required>
            <option value="5" <?= ($user[0]['ID_Rol'] == 5) ? 'selected' : '' ?>>Administrador</option>
            <option value="6" <?= ($user[0]['ID_Rol'] == 6) ? 'selected' : '' ?>>Supervisor</option>
            <option value="7" <?= ($user[0]['ID_Rol'] == 7) ? 'selected' : '' ?>>Usuario</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="ID_Tarjeta">Tarjeta</label>
          <select name="ID_Tarjeta" id="ID_Tarjeta" required>
            <option value="">Seleccione una tarjeta</option>
            <?php foreach ($tarjetas as $tarjeta): ?>
              <option value="<?= $tarjeta['ID_Tarjeta'] ?>" <?= ($tarjeta['ID_Tarjeta'] == $user[0]['ID_Tarjeta']) ? 'selected' : '' ?>>
                Tarjeta <?= $tarjeta['ID_Tarjeta'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <input type="hidden" name="id" value="<?= $user[0]['ID_Usuario'] ?>">
        <button type="submit" class="btn-submit">Actualizar Usuario</button>
        <a href="modificar-usuario" class="btn-back">← Volver al listado</a>
      </form>
    </div>
  </div>

  <!-- Mensajes de error/éxito -->
  <?php
    if (isset($error)) {
      echo '<div class="mensaje error">'.$error.'</div>';
    } elseif (isset($success)) {
      echo '<div class="mensaje success">'.$success.'</div>';
    }
  ?>

  <script>
    // Cerrar sesión
    function cerrarsesion(url){
      if(confirm('¿Seguro que deseas cerrar sesión?')){
        window.location.href=url;
      }
    }
  </script>
</body>
</html>