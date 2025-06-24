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
    <title>Gestión de Tarjetas RFID</title>
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

      /* Estilos para la tabla de tarjetas */
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

      .add-card-btn { 
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

      .add-card-btn:hover { 
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

      .cards-table { 
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      .cards-table th, 
      .cards-table td { 
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
      }

      .cards-table th { 
        background-color: #f8f9fa;
        font-weight: bold;
        color: #2c3e50;
      }

      .cards-table tr:nth-child(even) { 
        background-color: #f8f9fa;
      }

      .cards-table tr:hover { 
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

      .activate-btn { 
        background-color: #27ae60;
        color: white;
      }

      .activate-btn:hover { 
        background-color: #219653;
      }

      .deactivate-btn { 
        background-color: #e67e22;
        color: white;
      }

      .deactivate-btn:hover { 
        background-color: #d35400;
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
        
        .cards-table th,
        .cards-table td {
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
        
        .cards-table th,
        .cards-table td {
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
        <h3 class="modal-title">¿Estás seguro de que deseas eliminar esta tarjeta?</h3>
        <form id="formEliminar" method="post" action="<?= site_url('eliminar-tarjeta') ?>">
          <input type="hidden" name="ID_Tarjeta" id="idTarjetaEliminar">
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

      <a href="<?php echo site_url('/bienvenido');?>" class="menu-item">
        <i class="fas fa-home"></i> Inicio
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
      <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item active">
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
          <h1>Gestión de Tarjetas RFID</h1>
          <div class="admin-actions">
            <a href="<?php echo site_url('/crear-tarjeta'); ?>" class="add-card-btn">
              <i class="fas fa-plus-circle"></i> Añadir Tarjeta
            </a>
            <input type="text" placeholder="Buscar tarjeta..." class="search-input" id="searchInput">
          </div>
        </div>
        
        <table class="cards-table">
          <thead>
            <tr>
              <th>ID Tarjeta</th>
              <th>UID</th>
              <th>Asignada a Usuario</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tarjetas as $tarjeta): ?>
              <tr>
                <td><?= esc($tarjeta['ID_Tarjeta']); ?></td>
                <td><?= esc($tarjeta['UID']); ?></td>
                <td>
                  <?php 
                    // Dado que el controlador y modelo no se modifican para hacer JOINs,
                    // 'Nombre_Usuario' y 'Apellido_Usuario' no estarán disponibles.
                    // Si el campo 'ID_Usuario' existe en la tabla tarjeta_acceso y es parte de $tarjeta
                    // podrías mostrar 'ID_Usuario' para indicar la asignación.
                    // De lo contrario, se asume que no está asignada por nombre.
                    // Aquí asumimos que ID_Usuario no es parte del array $tarjeta de findAll()
                    // o no lo necesitas para mostrar el nombre directamente.
                    echo 'No Asignada'; // Opcional: Si ID_Usuario está en $tarjeta: (isset($tarjeta['ID_Usuario']) && !empty($tarjeta['ID_Usuario'])) ? 'Asignada (ID: ' . esc($tarjeta['ID_Usuario']) . ')' : 'No Asignada';
                  ?>
                </td>
                <td class="<?= $tarjeta['Estvdo'] == 1 ? 'estado-activa' : 'estado-inactiva'; ?>">
                  <?= $tarjeta['Estado'] == 1 ? 'Activa' : 'Inactiva'; ?>
                </td>
                <td>
                  <div class="btn-group">
                    <form action="<?= site_url('modificar-tarjeta2') ?>" method="post" style="display: inline-block;">
                      <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">
                      <button type="submit" class="action-btn edit-btn">Modificar</button>
                    </form>
                    <?php if ($tarjeta['Estado'] == 0): ?>
                      <form action="<?= site_url('desbloquear-tarjeta') ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">
                        <button type="submit" class="action-btn activate-btn">Activar</button>
                      </form>
                    <?php else: ?>
                      <form action="<?= site_url('bloquear-tarjeta') ?>" method="post" style="display: inline-block;">
                        <input type="hidden" name="ID_Tarjeta" value="<?= esc($tarjeta['ID_Tarjeta']); ?>">
                        <button type="submit" class="action-btn deactivate-btn">Desactivar</button>
                      </form>
                    <?php endif; ?>
                    <button type="button" class="action-btn delete-btn" onclick="mostrarModal('<?= esc($tarjeta['ID_Tarjeta']); ?>')">
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
        if(confirm('¿Estás seguro de que deseas cerrar sesión?')){
          window.location.href=url;
        }
      }

      // Filtrado en tiempo real para la tabla de tarjetas
      const barraBusqueda = document.getElementById('searchInput');
      const filasTarjeta = document.querySelectorAll('.cards-table tbody tr');

      barraBusqueda.addEventListener('input', function() {
        const valorBusqueda = barraBusqueda.value.toLowerCase();

        filasTarjeta.forEach(fila => {
          const idTarjeta = fila.querySelector('td:nth-child(1)').innerText.toLowerCase();
          const uidTarjeta = fila.querySelector('td:nth-child(2)').innerText.toLowerCase();
          // La columna 3 es "Asignada a Usuario", que actualmente dice "No Asignada".
          // Si tuvieras el ID_Usuario en el array $tarjeta, podrías incluirlo aquí para la búsqueda.
          // Por ejemplo: const idUsuario = fila.querySelector('td:nth-child(3)').innerText.toLowerCase();
          // Actualmente, solo busca por ID_Tarjeta y UID.
          
          if (idTarjeta.includes(valorBusqueda) || uidTarjeta.includes(valorBusqueda)) {
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