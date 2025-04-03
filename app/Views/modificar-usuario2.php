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
    <title>Modificar Usuario (Vista 2)</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* === ESTILOS GENERALES (NUEVO) === */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* === SIDEBAR (ESTILO NUEVO) === */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #2c3e50, #34495e);
            padding-top: 20px;
            color: #ecf0f1;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            z-index: 1000;
        }

        .sidebar:hover {
            width: 260px;
            background: linear-gradient(180deg, #34495e, #2c3e50);
        }

        .sidebar a {
            padding: 12px 20px;
            margin: 8px 15px;
            text-decoration: none;
            font-size: 16px;
            color: #bdc3c7;
            display: flex;
            align-items: center;
            border-radius: 6px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar a:hover {
            background: #3498db;
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar .logo {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #ecf0f1;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .menu-heading {
            padding: 10px 20px;
            font-size: 14px;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }

        /* === FORMULARIO (ESTILO NUEVO) === */
        .modificar-container {
            margin-left: 280px;
            padding: 30px;
            display: flex;
            justify-content: center;
        }

        .modificar-card {
            background: white;
            width: 450px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .modificar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .modificar-card h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 28px;
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
            border-radius: 8px;
            font-size: 15px;
            transition: border 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #3498db;
            outline: none;
        }

        .btn-submit {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            transform: translateY(-2px);
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .btn-back:hover {
            color: #2c3e50;
        }

        /* === MENSAJES === */
        .alert-error {
            color: #e74c3c;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 6px;
        }

        .alert-success {
            color: #27ae60;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background: rgba(39, 174, 96, 0.1);
            border-radius: 6px;
        }
    </style>
</head>
<body>
<!-- === SIDEBAR (NUEVO ESTILO) === -->
<div class="sidebar">
  <div class="logo">
    <?= ($rol == 5) ? "Administrador" : (($rol == 6) ? "Supervisor" : "Usuario" ?>
  </div>
  <div class="menu-heading">Menu</div>
  <a href="<?= site_url('/bienvenido') ?>" class="menu-item">
    <i class="fas fa-home"></i> Inicio
  </a>
  
  <?php if ($rol == 5): ?>
    <div class="menu-heading">Usuarios</div>
    <a href="<?= site_url('/modificar-usuario') ?>" class="menu-item">
      <i class="fas fa-users-cog"></i> Gestor de Usuarios
    </a>
  <?php endif; ?>
  
  <div class="menu-heading">Tarjetas</div>
  <?php if ($rol == 5): ?>
    <a href="<?= site_url('/modificar-tarjeta') ?>" class="menu-item">
      <i class="fas fa-credit-card"></i> Gestor de Tarjetas
    </a>
  <?php endif; ?>
  
  <a href="<?= site_url('/consultar-rfid') ?>" class="menu-item">
    <i class="fas fa-search"></i> Consultar Tarjetas
  </a>
  
  <?php if ($rol == 5 || $rol == 6): ?>
    <div class="menu-heading">Reportes</div>
    <a href="<?= site_url('/ver-alertas') ?>" class="menu-item">
      <i class="fas fa-bell"></i> Alertas
    </a>
    <a href="<?= site_url('/ver-accesos-tarjeta') ?>" class="menu-item">
      <i class="fas fa-door-open"></i> Accesos
    </a>
    <a href="<?= site_url('/historial-cambios') ?>" class="menu-item">
      <i class="fas fa-history"></i> Historial
    </a>
  <?php endif; ?>
  
  <div class="menu-heading">Sesión</div>
  <a onclick="cerrarsesion('<?= site_url('/logout') ?>')" class="menu-item">
    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
  </a>
</div>

<!-- === CONTENIDO PRINCIPAL === -->
<div class="modificar-container">
    <div class="modificar-card">
        <h1>Editar Usuario</h1>
        <form action="<?= site_url('/actualizar-usuario') ?>" method="post">
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre" id="Nombre" value="<?= esc($user[0]['Nombre']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="Email">Correo</label>
                <input type="email" name="Email" id="Email" value="<?= esc($user[0]['Email']) ?>" required>
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
                    <option value="">Seleccione...</option>
                    <?php foreach ($tarjetas as $tarjeta): ?>
                        <option value="<?= $tarjeta['ID_Tarjeta'] ?>" <?= ($tarjeta['ID_Tarjeta'] == $user[0]['ID_Tarjeta']) ? 'selected' : '' ?>>
                            Tarjeta <?= $tarjeta['ID_Tarjeta'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <input type="hidden" name="id" value="<?= $user[0]['ID_Usuario'] ?>">
            <button type="submit" class="btn-submit">Guardar Cambios</button>
            <a href="modificar-usuario" class="btn-back">← Volver al listado</a>
        </form>
        
        <?php if (isset($error)): ?>
            <div class="alert-error"><?= $error ?></div>
        <?php elseif (isset($success)): ?>
            <div class="alert-success"><?= $success ?></div>
        <?php endif; ?>
    </div>
</div>

<script>
function cerrarsesion(url) {
    if (confirm('¿Seguro que deseas cerrar sesión?')) {
        window.location.href = url;
    }
}
</script>
</body>
</html>