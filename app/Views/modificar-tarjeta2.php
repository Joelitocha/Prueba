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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Tarjeta</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/modtar2.css'); ?>"> <!-- Enlazando el CSS del Sidebar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      .modtar{
        padding-left: 10px;
        border: 4px black solid;
        margin-left: 270px;
        padding-right: 0px;
        margin-right: 1200px;
        padding-bottom: 10px;
      }
      .titulo{
        padding-left: 270px;
        margin-right: 7px;
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
<div class="modtar">
    <h1>Modificar Tarjeta</h1>
    <!-- Formulario de actualización de la tarjeta -->
    <form action="<?= site_url('actualizar-tarjeta') ?>" method="post">
        <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">

        <select name="estado" required>
          <option value="1">Activa</option>
          <option value="0">Inactiva</option>
        </select>

        <input type="submit" value="Actualizar Tarjeta">
    </form>
    </div>
</body>
</html>
