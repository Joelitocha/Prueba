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

<!doctype html>
<html lang="es">
  <head>
    <title>Gestión de Usuarios</title>
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

      /* Contenedor del título */
      .titulo {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
      }

      .titulo h1 {
        margin: 0;
        font-size: 28px;
        color: #2c3e50;
      }

      /* Contenedor de acciones */
      .titulo .acciones {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin-top: 15px;
        flex-wrap: wrap;
        width: 100%;
      }

      /* Botón "Añadir Usuario" */
      .titulo .menu-item {
        display: inline-flex;
        align-items: center;
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 15px;
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
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 15px;
        width: 300px;
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
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
      }

      .modificar {
        width: 100%;
        border-collapse: collapse;
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

      /* Estados de usuario */
      .estado-activo {
        color: #27ae60;
        font-weight: bold;
      }

      .estado-inactivo {
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
        
        .content {
          margin-left: 0;
          padding: 20px;
        }
        
        .menu-toggle {
          display: block;
        }

        .mensaje {
          margin: 15px 20px;
        }

        .titulo h1 {
          font-size: 24px;
        }
        
        .barra-busqueda {
          width: 100%;
        }
      }

      @media (max-width: 768px) {
        .titulo .acciones {
          flex-direction: column;
          gap: 10px;
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
          font-size: 22px;
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
          font-size: 20px;
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
    </style>
  </head>
  <body>
    <!-- Botón para mostrar/ocultar menú en móviles -->
    <button class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars"></i> Menú
    </button>

    <!-- Modal de confirmación -->
    <div id="modalConfirmacion">
      <div>
          <h3>¿Quieres borrar este usuario?</h3>
          <form id="formEliminar" method="post" action="<?= site_url('eliminar-usuario') ?>">
              <input type="hidden" name="ID_Usuario" id="idUsuarioEliminar">
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

      <a href="<?php echo site_url('/bienvenido');?>" class="menu-item">
        <i class="fas fa-home"></i> Inicio
      </a>
      
      <!-- Opciones para Administrador -->
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Administración</div>
      <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item active">
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
      <div class="titulo">
        <h1>Gestión de Usuarios</h1>
        <div class="acciones">
          <a href="<?php echo site_url('/crear-usuario'); ?>" class="menu-item">
            <i class="fas fa-user-plus"></i> Añadir Usuario
          </a>
          <input type="text" placeholder="Buscar usuario..." class="barra-busqueda" id="searchInput">
        </div>
      </div>
      
      <div class="tabla-container">
        <table class="modificar">
          <thead>
            <tr>
              <th>ID Usuario</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario): ?>
              <tr>
                <td><?= esc($usuario['ID_Usuario']); ?></td>
                <td><?= esc($usuario['Nombre']); ?></td>
                <td><?= esc($usuario['Apellido']); ?></td>
                <td><?= esc($usuario['Email']); ?></td>
                <td>
                  <?php 
                    if ($usuario['ID_Rol'] == 5) {
                        echo 'Administrador';
                    } elseif ($usuario['ID_Rol'] == 6) {
                        echo 'Supervisor';
                    } elseif ($usuario['ID_Rol'] == 7) {
                        echo 'Usuario';
                    }
                  ?>
                </td>
                <td class="<?= $usuario['Estado'] == 1 ? 'estado-activo' : 'estado-inactivo'; ?>">
                  <?= $usuario['Estado'] == 1 ? 'Activo' : 'Inactivo'; ?>
                </td>
                <td>
                  <div class="btn-group">
                    <form action="<?= site_url('modificar-usuario2') ?>" method="post">
                      <input type="hidden" name="ID_Usuario" value="<?= esc($usuario['ID_Usuario']); ?>">
                      <input type="submit" value="Modificar" class="btn-modificar">
                    </form>
                    <?php if ($usuario['Estado'] == 0): ?>
                      <form action="<?= site_url('desbloquear-usuario') ?>" method="post">
                        <input type="hidden" name="ID_Usuario" value="<?= esc($usuario['ID_Usuario']); ?>">
                        <input type="submit" value="Activar" class="btn-desbloquear">
                      </form>
                    <?php else: ?>
                      <form action="<?= site_url('bloquear-usuario') ?>" method="post">
                        <input type="hidden" name="ID_Usuario" value="<?= esc($usuario['ID_Usuario']); ?>">
                        <input type="submit" value="Desactivar" class="btn-bloquear">
                      </form>
                    <?php endif; ?>
                    <button type="button" class="btn-eliminar" onclick="mostrarModal('<?= esc($usuario['ID_Usuario']); ?>')">
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
      function mostrarModal(idUsuario) {
        document.getElementById('idUsuarioEliminar').value = idUsuario;
        document.getElementById('modalConfirmacion').style.display = 'flex';
      }

      function cerrarModal() {
        document.getElementById('modalConfirmacion').style.display = 'none';
      }

      // Cerrar sesión
      function cerrarsesion(url){
        if(confirm('¿Estás seguro de que deseas cerrar sesión?')){
          window.location.href=url;
        }
      }

      // Filtrado en tiempo real para la tabla de usuarios
      const barraBusqueda = document.getElementById('searchInput');
      const filasUsuario = document.querySelectorAll('.modificar tbody tr');

      barraBusqueda.addEventListener('input', function() {
        const valorBusqueda = barraBusqueda.value.toLowerCase();

        filasUsuario.forEach(fila => {
          const idUsuario = fila.querySelector('td:first-child').innerText.toLowerCase();
          const nombreUsuario = fila.querySelector('td:nth-child(2)').innerText.toLowerCase();
          const apellidoUsuario = fila.querySelector('td:nth-child(3)').innerText.toLowerCase();
          const emailUsuario = fila.querySelector('td:nth-child(4)').innerText.toLowerCase();

          if (idUsuario.includes(valorBusqueda) || nombreUsuario.includes(valorBusqueda) || 
              apellidoUsuario.includes(valorBusqueda) || emailUsuario.includes(valorBusqueda)) {
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