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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/mod2.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* === ESTILOS GENERALES === */
        body {
            font-family: Arial, sans-serif;
            background-image: url("../images/bg1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s ease-in-out;
        }

        /* === SIDEBAR (Mismo estilo que el primer archivo) === */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #000706, #00272d);
            padding-top: 20px;
            font-family: Arial, sans-serif;
            color: #bfac8b;
            transition: background 1.5s ease-in-out, width 0.5s ease-in-out;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
            overflow-y: auto;
            scrollbar-width: none;
            z-index: 1000;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar:hover {
            width: 270px;
            background: linear-gradient(180deg, #00272d, #134647);
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.6);
        }

        .sidebar a {
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            color: #bfac8b;
            display: flex;
            align-items: center;
            border-radius: 8px;
            margin: 10px 15px;
            background-color: rgba(255, 255, 255, 0.05);
            transition: all 0.4s ease;
            box-shadow: inset 0 0 0 rgba(0, 0, 0, 0.1);
        }

        .sidebar a:hover {
            background-color: #0c7e7e;
            color: #fff;
            transform: translateX(12px);
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.3), inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 20px;
            color: #bfac8b;
            transition: color 0.3s ease;
        }

        .sidebar a:hover i {
            color: #fff;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #bfac8b;
            animation: fadeIn 1.5s ease-in-out;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
        }

        .sidebar .menu-heading {
            padding-left: 15px;
            text-transform: uppercase;
            font-weight: bold;
            margin-top: 25px;
            font-size: 15px;
            color: #bfac8b;
            border-bottom: 1px solid #bfac8b;
            padding-bottom: 8px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .sidebar .menu-heading:last-of-type {
            margin-top: 40px;
        }

        .sidebar a:last-of-type {
            margin-bottom: 30px;
        }

        /* === FORMULARIO (Mismo estilo que el primer archivo) === */
        .modificar {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 265px;
            padding: 30px;
            width: 35%;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
            align-items: stretch;
        }

        .modificar h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .modificar label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .modificar input, 
        .modificar select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .modificar input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .modificar input[type="submit"]:hover {
            background-color: #45a049;
        }

        .modificar a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .modificar a:hover {
            text-decoration: underline;
        }

        /* === MENSAJES DE ERROR/ÉXITO === */
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }

        /* === ANIMACIONES === */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
<!-- === SIDEBAR (Mismo que el primer archivo) === -->
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
  <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item">
    <i class="fas fa-user-edit"></i> Gestor de Usuarios
  </a>
<?php endif; ?>
<!-- Opciones para Tarjetas disponibles para todos los roles -->
<div class="menu-heading">Tarjetas</div>
<!-- Administrador puede gestionar tarjetas -->
<?php if ($rol == 5): ?>
  <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item">
    <i class="fas fa-user-edit"></i> Gestor de Tarjetas
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
  <a href="<?php echo site_url('/historial-cambios');?>" class="menu-item">
    <i class="fas fa-history"></i> Ver Historial de Cambios
  </a>
<?php endif; ?>
<!-- Nueva Categoría para Cerrar Sesión -->
<div class="menu-heading">Cerrar Sesión</div>
<a onclick="cerrarsesion('<?php echo site_url('/logout');?>')" class="menu-item">
  <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
</a>
</div>
<!-- === FIN SIDEBAR === -->

<!-- === CONTENIDO PRINCIPAL (Formulario de modificación) === -->
<div class="modificar">
    <h1>Modificar Usuario</h1>
    <form action="<?php echo site_url('/actualizar-usuario') ?>" method="post">
        
        <label for="Nombre">Nombre de Usuario</label>
        <input type="text" name="Nombre" id="Nombre" value="<?= esc($user[0]['Nombre']) ?>" required maxlength="50">

        <label for="Email">Correo Electrónico</label>
        <input type="email" name="Email" id="Email" value="<?= esc($user[0]['Email']) ?>" required maxlength="100">

        <label for="ID_Rol">ID Rol</label>
        <select name="ID_Rol" id="ID_Rol" required>
            <option value="5" <?= ($user[0]['ID_Rol'] == 5) ? 'selected' : ''; ?>>Administrador</option>
            <option value="6" <?= ($user[0]['ID_Rol'] == 6) ? 'selected' : ''; ?>>Supervisor</option>
            <option value="7" <?= ($user[0]['ID_Rol'] == 7) ? 'selected' : ''; ?>>Usuario</option>
        </select>

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
        <input type="submit" value="Actualizar">
        <a href="modificar-usuario">Volver</a>
    </form>
</div>

<!-- === MENSAJES DE ERROR/ÉXITO === -->
<?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    } elseif (isset($success)) {
        echo "<p class='success'>$success</p>";
    }
?>

<!-- === SCRIPT PARA CERRAR SESIÓN === -->
<script>
function cerrarsesion(url){
  if(confirm('¿Seguro Queres Cerrar Sesion?')){
    window.location.href=url;
  }
}
</script>
</body>
</html>