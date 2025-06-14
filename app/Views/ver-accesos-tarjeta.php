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
    <title>Ver Accesos de Tarjeta</title>
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

    /* Contenedor del título */
    .titulo {
        text-align: center;
        padding: 20px 0;
        margin-bottom: 20px;
    }

    .titulo h1 {
        color: #3498db;
        font-size: 28px;
        margin: 0;
    }

    /* Tabla de accesos */
    .tabla-container {
        overflow-x: auto;
        margin-bottom: 30px;
    }

    .tabla-accesos {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .tabla-accesos th {
        background-color: #3498db;
        color: white;
        padding: 12px 15px;
        text-align: center;
    }

    .tabla-accesos td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    .tabla-accesos tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .tabla-accesos tr:hover {
        background-color: #f1f8ff;
    }

    .acceso-permitido {
        color: #27ae60;
        font-weight: bold;
    }

    .acceso-bloqueado {
        color: #e74c3c;
        font-weight: bold;
    }

    /* Paginación */
    .paginacion {
        display: flex;
        justify-content: center;
        margin: 20px 0;
        flex-wrap: wrap;
    }

    .paginacion a {
        margin: 0 5px;
        padding: 8px 12px;
        background-color: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
        margin-bottom: 5px;
    }

    .paginacion a:hover {
        background-color: #2980b9;
    }

    .paginacion a.activa {
        background-color: #2980b9;
        font-weight: bold;
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
        
        .tabla-container {
            margin: 0 10px;
        }
    }

    @media (max-width: 768px) {
        .tabla-accesos {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        
        .titulo h1 {
            font-size: 24px;
        }
        
        .tabla-accesos th, 
        .tabla-accesos td {
            padding: 10px 12px;
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
        
        .titulo h1 {
            font-size: 22px;
        }
        
        .paginacion a {
            padding: 6px 10px;
            font-size: 14px;
            margin: 0 3px;
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
    <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item">
      <i class="fas fa-exclamation-triangle"></i> Ver Alertas
    </a>
    <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item active">
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
    <div class="titulo">
      <h1>Registros de Accesos</h1>
    </div>
    
    <div class="tabla-container">
      <table class="tabla-accesos">
        <thead>
          <tr>
            <th>ID Acceso</th>
            <th>Fecha y Hora</th>
            <th>Resultado</th>
            <th>ID Tarjeta</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($registros as $registro): ?>
          <tr>
            <td><?= esc($registro['ID_Acceso']); ?></td>
            <td><?= esc($registro['Fecha_Hora']); ?></td>
            <td class="<?= $registro['Resultado'] == 1 ? 'acceso-permitido' : 'acceso-bloqueado'; ?>">
              <?= $registro['Resultado'] == 1 ? 'Permitido' : 'Bloqueado'; ?>
            </td>
            <td><?= esc($registro['ID_Tarjeta']); ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    
    <?php if ($totalPaginas > 1): ?>
<div class="paginacion">
    <?php 
    // Mostrar botón para página anterior
    if ($paginaActual > 1): ?>
        <a href="?pagina=<?= $paginaActual - 1; ?>">‹ Anterior</a>
    <?php endif; ?>
    
    <?php 
    // Mostrar las primeras 3 páginas
    for ($i = 1; $i <= min(3, $totalPaginas); $i++): ?>
        <a href="?pagina=<?= $i; ?>" class="<?= $i == $paginaActual ? 'activa' : ''; ?>"><?= $i; ?></a>
    <?php endfor; 
    
    // Mostrar puntos suspensivos y página actual si está en el medio
    if ($paginaActual > 3 && $paginaActual < $totalPaginas - 2): ?>
        <span>...</span>
        <a href="?pagina=<?= $paginaActual; ?>" class="activa"><?= $paginaActual; ?></a>
        <span>...</span>
    <?php elseif ($totalPaginas > 4 && $paginaActual <= $totalPaginas - 3): ?>
        <span>...</span>
    <?php endif; 
    
    // Mostrar las últimas páginas si la actual no está cerca
    if ($paginaActual >= $totalPaginas - 2 && $totalPaginas > 3):
        for ($i = max(4, $totalPaginas - 2); $i <= $totalPaginas; $i++): ?>
            <a href="?pagina=<?= $i; ?>" class="<?= $i == $paginaActual ? 'activa' : ''; ?>"><?= $i; ?></a>
        <?php endfor;
    // Mostrar solo la última página si la actual no está cerca
    elseif ($totalPaginas > 3): ?>
        <a href="?pagina=<?= $totalPaginas; ?>" class="<?= $paginaActual == $totalPaginas ? 'activa' : ''; ?>"><?= $totalPaginas; ?></a>
    <?php endif; ?>
    
    <?php 
    // Mostrar botón para página siguiente
    if ($paginaActual < $totalPaginas): ?>
        <a href="?pagina=<?= $paginaActual + 1; ?>">Siguiente ›</a>
    <?php endif; ?>
</div>
<?php endif; ?>

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