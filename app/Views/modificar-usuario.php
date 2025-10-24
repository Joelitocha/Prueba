<?php
    $session = session();
    $rol = $session->get("ID_Rol");
?>

<!doctype html>
<html lang="es">
  <head>
    <title>Administración de Usuarios</title>
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

      /* Estilos para la tabla de usuarios */
      .admin-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
      }

      .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
      }

      .admin-header h1 {
        font-size: 24px;
        color: #2c3e50;
        margin: 0;
      }

      .admin-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
      }

      .add-user-btn {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
      }

      .add-user-btn:hover {
        background-color: #2980b9;
      }

      .search-input {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        min-width: 250px;
        transition: border-color 0.3s ease;
      }

      .search-input:focus {
        border-color: #3498db;
        outline: none;
      }

      .users-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      .users-table th,
      .users-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
      }

      .users-table th {
        background-color: #f8f9fa;
        font-weight: bold;
        color: #2c3e50;
      }

      .users-table tr:nth-child(even) {
        background-color: #f8f9fa;
      }

      .users-table tr:hover {
        background-color: #f1f8ff;
      }

      /* Estilos para los roles */
      .role-admin {
        color: #3498db;
        font-weight: bold;
      }

      .role-supervisor {
        color: #e67e22;
        font-weight: bold;
      }

      .role-user {
        color: #2ecc71;
        font-weight: bold;
      }

      /* Estilos para los botones */
      .action-btn {
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        margin: 2px;
      }

      .edit-btn {
        background-color: #3498db;
        color: white;
      }

      .edit-btn:hover {
        background-color: #2980b9;
      }

      .delete-btn {
        background-color: #e74c3c;
        color: white;
      }

      .delete-btn:hover {
        background-color: #c0392b;
      }

      /* Modal de confirmación */
      .modal {
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

      .modal-content {
        background-color: white;
        padding: 25px;
        border-radius: 8px;
        width: 90%;
        max-width: 400px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
      }

      .modal-title {
        margin-bottom: 20px;
        color: #2c3e50;
        text-align: center;
      }

      .modal-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
      }

      .modal-btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
      }

      .cancel-btn {
        background-color: #95a5a6;
        color: white;
      }

      .cancel-btn:hover {
        background-color: #7f8c8d;
      }

      .confirm-btn {
        background-color: #e74c3c;
        color: white;
      }

      .confirm-btn:hover {
        background-color: #c0392b;
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
      @media (max-width: 1200px) {
        .admin-actions {
          gap: 10px;
        }
        
        .search-input {
          min-width: 200px;
        }
      }

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
        .admin-header {
          flex-direction: column;
          align-items: flex-start;
        }
        
        .admin-actions {
          width: 100%;
        }
        
        .search-input {
          flex-grow: 1;
          min-width: auto;
        }
        
        .users-table th,
        .users-table td {
          padding: 10px 12px;
          font-size: 14px;
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        .content {
          padding: 20px;
        }
        
        .admin-container {
          padding: 20px;
        }
        
        .users-table th,
        .users-table td {
          padding: 8px 10px;
          font-size: 13px;
        }
        
        .action-btn {
          padding: 6px 10px;
          font-size: 13px;
        }
        
        .modal-content {
          padding: 20px;
        }
      }
      @media (max-width: 768px) {
  body {
    overflow-x: hidden;
  }

  .sidebar {
    transform: translateX(-100%);
    position: fixed;
    z-index: 1000;
    width: 230px;
    transition: transform 0.3s ease-in-out;
  }

  .sidebar.active {
    transform: translateX(0);
  }

  .menu-toggle {
    display: block;
    z-index: 1101;
  }

  .content {
    margin-left: 0;
    padding: 20px;
  }

  .admin-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }

  .admin-actions {
    flex-direction: column;
    width: 100%;
    align-items: stretch;
  }

  .search-input {
    width: 100%;
    box-sizing: border-box;
  }

  .users-table th,
  .users-table td {
    padding: 10px;
    font-size: 14px;
    word-break: break-word;
  }

  .action-btn {
    width: 100%;
    margin: 5px 0;
    font-size: 14px;
  }

  .mensaje {
    margin: 15px 0;
    width: 100%;
    box-sizing: border-box;
  }

  .modal-content {
    width: 95%;
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
    <div class="modal" id="modalConfirmacion">
      <div class="modal-content">
        <h3 class="modal-title">¿Estás seguro de que deseas eliminar este usuario?</h3>
        <form id="formEliminar" method="post" action="<?= site_url('eliminar-usuarios') ?>">
          <input type="hidden" name="id" id="idUsuarioEliminar">
          <div class="modal-actions">
            <button type="button" class="modal-btn cancel-btn" onclick="cerrarModal()">Cancelar</button>
            <button type="submit" class="modal-btn confirm-btn">Eliminar</button>
          </div>
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
      <div class="admin-container">
        <div class="admin-header">
          <h1>Administración de Usuarios</h1>
          <div class="admin-actions">
            <a href="<?php echo site_url('/register'); ?>" class="add-user-btn">
              <i class="fas fa-user-plus"></i> Añadir Usuario
            </a>
            <input type="text" placeholder="Buscar usuario..." class="search-input" id="searchInput">
          </div>
        </div>
        
        <table class="users-table">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Tarjeta</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($user as $u): ?>
            <tr>
              <td><?php echo $u["Nombre"]; ?></td>
              <td><?php echo $u["Email"]; ?></td>
              <td>
                <?php 
                $rolNombre = "";
                $rolClase = "";
                switch ($u["ID_Rol"]) {
                  case 5:
                    $rolNombre = "Administrador";
                    $rolClase = "role-admin";
                    break;
                  case 6:
                    $rolNombre = "Supervisor";
                    $rolClase = "role-supervisor";
                    break;
                  case 7:
                    $rolNombre = "Usuario";
                    $rolClase = "role-user";
                    break;
                  default:
                    $rolNombre = "Desconocido";
                }
                ?>
                <span class="<?php echo $rolClase; ?>"><?php echo $rolNombre; ?></span>
              </td>
              <td><?php echo $u["ID_Tarjeta"]; ?></td>
              <td>
                <div style="display: flex; gap: 5px;">
                  <!-- Botón Modificar (siempre visible) -->
                  <form action="<?= site_url('modificar-usuario2') ?>" method="post">
                    <input type="hidden" value="<?php echo $u["ID_Usuario"]; ?>" name="id">
                    <button type="submit" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i> Modificar
                    </button>
                  </form>

                  <!-- Solo mostrar botón Eliminar si NO es el mismo usuario en sesión -->
                  <?php if ($u["ID_Usuario"] != $idSesion): ?>
                    <button type="button" class="action-btn delete-btn" onclick="mostrarModal(<?php echo $u['ID_Usuario']; ?>)">
                      <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                  <?php endif; ?>
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
      const filasUsuario = document.querySelectorAll('.users-table tbody tr');

      barraBusqueda.addEventListener('input', function() {
        const valorBusqueda = barraBusqueda.value.toLowerCase();

        filasUsuario.forEach(fila => {
          const nombreUsuario = fila.querySelector('td:first-child').innerText.toLowerCase();
          const emailUsuario = fila.querySelector('td:nth-child(2)').innerText.toLowerCase();
          const rolUsuario = fila.querySelector('td:nth-child(3)').innerText.toLowerCase();

          if (nombreUsuario.includes(valorBusqueda) || emailUsuario.includes(valorBusqueda) || rolUsuario.includes(valorBusqueda)) {
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