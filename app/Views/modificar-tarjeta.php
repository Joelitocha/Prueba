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
    <title>Administración de Tarjetas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    /* Estilos generales */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        min-height: 100vh;
    }

    /* Contenedor del título */
    .titulo {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        text-align: center;
        margin-left: 250px;
        transition: margin-left 0.3s ease;
    }

    .titulo h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    /* Contenedor de acciones */
    .titulo .acciones {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin-top: 10px;
        flex-wrap: wrap;
        width: 100%;
    }

    /* Botón "Añadir Tarjeta" */
    .titulo .menu-item {
        display: inline-flex;
        align-items: center;
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
        white-space: nowrap;
    }

    .titulo .menu-item:hover {
        background-color: #2980b9;
    }

    /* Barra de búsqueda */
    .barra-busqueda {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        width: 250px;
        max-width: 100%;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: border-color 0.3s ease;
        flex-grow: 1;
    }

    .barra-busqueda:focus {
        border-color: #3498db;
        outline: none;
    }

    /* Tabla */
    .tabla-container {
        padding: 20px;
        margin-left: 250px;
        transition: margin-left 0.3s ease;
        overflow-x: auto;
    }

    .modificar {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        min-width: 600px;
    }

    .modificar th,
    .modificar td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    .modificar th {
        background-color: #f8f9fa;
        font-weight: bold;
        color: #3498db;
    }

    .modificar tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .modificar tr:hover {
        background-color: #f1f8ff;
    }

    /* Estados de tarjeta */
    .estado-activa {
        color: #27ae60;
        font-weight: bold;
    }

    .estado-inactiva {
        color: #e74c3c;
        font-weight: bold;
    }

    /* Botones */
    .btn-modificar {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 2px;
    }

    .btn-bloquear {
        background-color: #e67e22;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 2px;
    }

    .btn-desbloquear {
        background-color: #27ae60;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 2px;
    }

    .btn-eliminar {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin: 2px;
    }

    .btn-modificar:hover {
        background-color: #2980b9;
    }

    .btn-bloquear:hover {
        background-color: #d35400;
    }

    .btn-desbloquear:hover {
        background-color: #219653;
    }

    .btn-eliminar:hover {
        background-color: #c0392b;
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

    /* Botón para mostrar/ocultar sidebar en móviles */
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
    }

    /* Modal de confirmación */
    #modalConfirmacion {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1100;
    }

    #modalConfirmacion div {
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        width: 90%;
        max-width: 320px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    #modalConfirmacion h3 {
        margin-bottom: 20px;
        color: #2c3e50;
    }

    #modalConfirmacion button {
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        margin: 0 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    #modalConfirmacion button[type="button"] {
        background: #95a5a6;
        color: white;
    }

    #modalConfirmacion button[type="button"]:hover {
        background: #7f8c8d;
    }

    #modalConfirmacion button[type="submit"] {
        background: #e74c3c;
        color: white;
    }

    #modalConfirmacion button[type="submit"]:hover {
        background: #c0392b;
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
        
        .titulo, .tabla-container, .mensaje {
            margin-left: 0;
            padding: 15px;
        }
        
        .menu-toggle {
            display: block;
        }
        
        .tabla-container {
            padding: 15px 10px;
        }
    }

    @media (max-width: 768px) {
        .titulo .acciones {
            flex-direction: column;
            gap: 10px;
        }
        
        .barra-busqueda {
            width: 100%;
            max-width: 100%;
        }
        
        .modificar th, 
        .modificar td {
            padding: 8px 10px;
            font-size: 14px;
        }
        
        .btn-modificar, 
        .btn-eliminar,
        .btn-bloquear,
        .btn-desbloquear {
            padding: 6px 10px;
            font-size: 13px;
        }
        
        .titulo h1 {
            font-size: 20px;
        }
        
        .sidebar {
            width: 220px;
        }
    }

    @media (max-width: 576px) {
        .sidebar {
            width: 200px;
        }
        
        .sidebar a {
            padding: 10px 12px;
            font-size: 14px;
        }
        
        .sidebar .logo {
            font-size: 20px;
        }
        
        .titulo h1 {
            font-size: 18px;
        }
        
        .mensaje {
            margin: 15px 10px;
            font-size: 14px;
        }
        
        .modificar th, 
        .modificar td {
            padding: 6px 8px;
            font-size: 13px;
        }
        
        .btn-modificar, 
        .btn-eliminar,
        .btn-bloquear,
        .btn-desbloquear {
            padding: 5px 8px;
            font-size: 12px;
        }
    }
    
    @media (max-width: 400px) {
        .sidebar {
            width: 180px;
        }
        
        .sidebar a {
            padding: 8px 10px;
            font-size: 13px;
        }
        
        .sidebar .logo {
            font-size: 18px;
        }
        
        .menu-toggle {
            padding: 8px;
        }
        
        .titulo {
            padding: 15px 10px;
        }
        
        .titulo h1 {
            font-size: 16px;
        }
        
        .mensaje {
            font-size: 13px;
            padding: 10px;
        }
        
        #modalConfirmacion div {
            padding: 15px;
        }
        
        #modalConfirmacion h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }
        
        #modalConfirmacion button {
            padding: 8px 15px;
            font-size: 14px;
        }
    }
    </style>
</head>
<body>
  <!-- Botón para mostrar/ocultar menú en móviles -->
  <button class="menu-toggle" id="menuToggle">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Modal de confirmación -->
  <div id="modalConfirmacion">
    <div>
        <h3>¿Quieres borrar esta tarjeta?</h3>
        <form id="formEliminar" method="post" action="<?= site_url('eliminar-tarjeta') ?>">
            <input type="hidden" name="ID_Tarjeta" id="idTarjetaEliminar">
            <button type="button" onclick="cerrarModal()">Cancelar</button>
            <button type="submit">Eliminar</button>
        </form>
    </div>
  </div>

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
    <div class="titulo">
      <h1>Administración de Tarjetas</h1>
      <div class="acciones">
        <a href="<?php echo site_url('/crear-tarjeta'); ?>" class="menu-item">
          <i class="fas fa-id-card"></i> Añadir Tarjeta
        </a>
        <input type="text" placeholder="Buscar tarjeta..." class="barra-busqueda" id="searchInput">
      </div>
    </div>
    
    <div class="tabla-container">
      <table class="modificar">
        <thead>
          <tr>
            <th>ID Tarjeta</th>
            <th>UID</th>
            <th>Estado</th>
            <th>Intentos Fallidos</th>
            <th>Fecha Expiración</th>
            <th>Horario Uso</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tarjetas as $tarjeta): ?>
            <tr>
              <td><?= esc($tarjeta['ID_Tarjeta']); ?></td>
              <td><?= esc($tarjeta['UID']); ?></td>
              <td class="<?= $tarjeta['Estado'] == 1 ? 'estado-activa' : 'estado-inactiva'; ?>">
                <?= $tarjeta['Estado'] == 1 ? 'Activa' : 'Inactiva'; ?>
              </td>
              <td><?= esc($tarjeta['Intentos_Fallidos']); ?></td>
              <td><?= esc($tarjeta['Fecha_Expiracion'] ?? 'Sin expiración'); ?></td>
              <td><?= esc($tarjeta['Horario_Uso'] ?? 'Sin restricción'); ?></td>
              <td>
                <div class="btn-group">
                  <form action="<?= site_url('modificar-tarjeta2') ?>" method="post">
                    <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">
                    <input type="submit" value="Modificar" class="btn-modificar">
                  </form>
                  <?php if ($tarjeta['Estado'] == 0): ?>
                    <form action="<?= site_url('desbloquear-tarjeta') ?>" method="post">
                      <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">
                      <input type="submit" value="Desbloquear" class="btn-desbloquear">
                    </form>
                  <?php else: ?>
                    <form action="<?= site_url('bloquear-tarjeta') ?>" method="post">
                      <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">
                      <input type="submit" value="Bloquear" class="btn-bloquear">
                    </form>
                  <?php endif; ?>
                  <button type="button" class="btn-eliminar" onclick="mostrarModal('<?= esc($tarjeta['ID_Tarjeta']); ?>')">
                    Eliminar
                  </button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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

    // Modal de confirmación
    function mostrarModal(idTarjeta) {
      document.getElementById('idTarjetaEliminar').value = idTarjeta;
      document.getElementById('modalConfirmacion').style.display = 'flex';
    }

    function cerrarModal() {
      document.getElementById('modalConfirmacion').style.display = 'none';
    }

    // Cerrar sesión
    function cerrarsesion(url){
      if(confirm('¿Seguro Queres Cerrar Sesion?')){
        window.location.href=url;
      }
    }

    // Filtrado en tiempo real para la tabla de tarjetas
    const barraBusqueda = document.getElementById('searchInput');
    const filasTarjeta = document.querySelectorAll('.modificar tbody tr');

    barraBusqueda.addEventListener('input', function() {
      const valorBusqueda = barraBusqueda.value.toLowerCase();

      filasTarjeta.forEach(fila => {
        const idTarjeta = fila.querySelector('td:first-child').innerText.toLowerCase();
        const uidTarjeta = fila.querySelector('td:nth-child(2)').innerText.toLowerCase();
        const estadoTarjeta = fila.querySelector('td:nth-child(3)').innerText.toLowerCase();

        if (idTarjeta.includes(valorBusqueda) || uidTarjeta.includes(valorBusqueda) || estadoTarjeta.includes(valorBusqueda)) {
          fila.style.display = '';
        } else {
          fila.style.display = 'none';
        }
      });
    });

    // Redimensionar la ventana
    window.addEventListener('resize', () => {
      if (window.innerWidth > 992) {
        sidebar.classList.remove('active');
      }
    });
    
    // Cerrar modal al hacer clic fuera
    document.getElementById('modalConfirmacion').addEventListener('click', function(e) {
      if (e.target === this) {
        cerrarModal();
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