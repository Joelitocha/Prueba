<?php

    $session = session();
    $rol = $session->get("ID_Rol");

?>
<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/mod2.css'); ?>"> <!-- Enlazando el CSS del Sidebar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      .content {
        margin-left: 250px;
        padding: 20px;
        transition: all 0.3s ease-in-out;
      }

      body {
        background: #F5F5F5;
        font-family: Arial, sans-serif;
      }
      .eliminar {
        width: 100%;
        border-right-width: 0px;
        justify-content: center; 
        align-items: center;
        padding-left: 247px;
      }
      .modificar{
        padding-left: 10px;
        border: 4px black solid;
        margin-left: 270px;
        padding-right: 0px;
        margin-right: 1200px;
        padding-bottom: 10px;
      }
    </style>
</head>
<body>
<!-- Incluir Sidebar -->
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

  <!-- Opciones para Administrador -->
<?php if ($rol == 5): ?>
  <div class="menu-heading">Usuarios</div>
  <a href="<?php echo site_url('/register');?>" class="menu-item">
    <i class="fas fa-user-plus"></i> Crear Usuarios
  </a>
  <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item">
    <i class="fas fa-user-edit"></i> Modificar Usuarios
  </a>
  <a href="<?php echo site_url('/eliminar-usuarios');?>" class="menu-item">
    <i class="fas fa-user-minus"></i> Eliminar Usuarios
  </a>
<?php endif; ?>

<!-- Opciones para Tarjetas disponibles para todos los roles -->
<div class="menu-heading">Tarjetas</div>



<!-- Administrador puede gestionar tarjetas -->
<?php if ($rol == 5): ?>
  <a href="<?php echo site_url('/crear-tarjeta');?>" class="menu-item">
    <i class="fas fa-id-card"></i> Crear Tarjeta
  </a>
  <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item"> <!-- Cambia "1" por el ID dinámico -->
    <i class="fas fa-user-edit"></i> Modificar Tarjeta
  </a>
  <a href="<?php echo site_url('/eliminar-tarjeta');?>" class="menu-item"> <!-- Cambia "1" por el ID dinámico -->
    <i class="fas fa-user-minus"></i> Eliminar Tarjeta
  </a>
<?php endif; ?>



<!-- Consultar estado de tarjetas, accesible para todos los roles -->
<a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item">
  <i class="fas fa-search"></i> Consultar Estado de Tarjetas
</a>

<!-- Opciones para Supervisor y Administrador -->
<?php if ($rol == 5 || $rol == 6): ?>
  <div class="menu-heading">Reportes</div>
  <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item">
    <i class="fas fa-exclamation-triangle"></i> Ver Alertas
  </a>
  <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item">
    <i class="fas fa-key"></i> Ver Accesos de Tarjeta
  </a>
  <a href="<?php echo site_url('/ver-historial-cambios');?>" class="menu-item">
    <i class="fas fa-history"></i> Ver Historial de Cambios
  </a>
<?php endif; ?>

<div class="logout">
  <a href="<?php echo site_url('/logout');?>" class="menu-item">
    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
  </a>
</div>
</div>
<!-- Fin Sidebar -->

<div class="modificar">
    <h1>Modificar Usuario</h1>
    <form action="<?php echo site_url('/actualizar-usuario') ?>" method="post">
    <label for="Nombre">Nombre de Usuario</label>
    <input type="text" name="Nombre" id="Nombre" value="<?= esc($user[0]['Nombre']) ?>" required maxlength="50"><br><br>
    <label for="Email">Correo Electrónico</label>
    <input type="email" name="Email" id="Email" value="<?= esc($user[0]['Email']) ?>" required maxlength="100"><br><br>
    <label for="ID_Rol">ID Rol</label>
    <select name="ID_Rol" id="ID_Rol" required>
        <option value="5" <?= ($user[0]['ID_Rol'] == 5) ? 'selected' : ''; ?>>Administrador</option>
        <option value="6" <?= ($user[0]['ID_Rol'] == 6) ? 'selected' : ''; ?>>Supervisor</option>
        <option value="7" <?= ($user[0]['ID_Rol'] == 7) ? 'selected' : ''; ?>>Usuario</option>
    </select><br><br>
    <label for="ID_Tarjeta">ID Tarjeta</label>
      <select name="ID_Tarjeta" id="ID_Tarjeta" required>
        <option value="">Seleccione una tarjeta</option>
          <?php foreach ($tarjetas as $tarjeta): ?>
        <option value="<?= $tarjeta['ID_Tarjeta']; ?>" <?= ($tarjeta['ID_Tarjeta'] == $user[0]['ID_Tarjeta']) ? 'selected' : ''; ?>>
            Tarjeta <?= $tarjeta['ID_Tarjeta']; ?>
        </option>
          <?php endforeach; ?>
        </select>
    <input type="hidden" value="<?php echo $user[0]['ID_Usuario']?>" name="id">
    <br> <br>
    <input type="submit" value="Actualizar">
</form>
</div>
<?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    } elseif (isset($success)) {
        echo "<p style='color: green;'>$success</p>";
    }
?>

</body>
</html>