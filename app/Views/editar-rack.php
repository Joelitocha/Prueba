<?php
$session = session();
$rol = $session->get("ID_Rol");
?>

<?php if ($rol != 5): ?>
  <p>No tenés permiso para ver esta página.</p>
  <?php return; ?>
<?php endif; ?>

<!doctype html>
<html lang="es">
  <head>
    <title>Editar Rack</title>
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

      /* Estilos para formularios */
      h1 {
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
      }

      .form-container {
        background-color: white;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        max-width: 600px;
        margin: 0 auto;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #2c3e50;
      }

      .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #dfe6e9;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s, box-shadow 0.3s;
      }

      .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
        outline: none;
      }

      .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
        flex-wrap: wrap;
      }

      .btn {
        display: inline-flex;
        align-items: center;
        color: white;
        padding: 10px 20px;
        border: none;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s ease;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        cursor: pointer;
      }

      .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        opacity: 0.9;
      }

      .btn i {
        margin-right: 8px;
        font-size: 14px;
      }

      .btn-primary {
        background-color: #3498db;
      }

      .btn-secondary {
        background-color: #95a5a6;
      }

      .btn-success {
        background-color: #2ecc71;
      }

      .btn-danger {
        background-color: #e74c3c;
      }

      .delete-section {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
      }

      .delete-section h3 {
        color: #e74c3c;
        margin-bottom: 15px;
      }

      /* Mensajes de alerta */
      .alert {
        padding: 12px 15px;
        border-radius: 6px;
        margin-bottom: 20px;
      }

      .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
      }

      .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
      }

      /* Modal de confirmación */
      .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
      }

      .modal-content {
        background-color: white;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.2);
        max-width: 500px;
        width: 90%;
      }

      .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 20px;
      }

      /* Media Queries para responsive */
      @media (max-width: 992px) {
        .sidebar { transform: translateX(-100%); }
        .sidebar.active { transform: translateX(0); }
        .content { margin-left: 0; }
        .menu-toggle { display: block; }
      }

      @media (max-width: 768px) {
        .content { padding: 20px; }
        .form-container { padding: 20px; }
      }

      @media (max-width: 576px) {
        .sidebar { width: 220px; }
        .form-actions { flex-direction: column; }
        .btn { width: 100%; justify-content: center; }
        .modal-actions { flex-direction: column; }
      }
    </style>
  </head>
  <body>
    <!-- Botón para mostrar/ocultar menú en móviles -->
    <button class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars"></i> Menú
    </button>

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
      <a class="btn btn-secondary" href="<?= site_url('dispositivo') ?>">
        <i class="fas fa-arrow-left"></i> Volver a lista de racks
      </a>
      
      <h1>Editar Rack</h1>
      
      <!-- Mostrar mensajes de error/success -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>
      
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <div class="form-container">
        <form action="<?= site_url('guardar-rack') ?>" method="post">
          <input type="hidden" name="id_rack" value="<?= $rack['ID_Rack'] ?>">
          
          <div class="form-group">
            <label for="ubicacion">Ubicación *</label>
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" 
                   value="<?= esc($rack['Ubicacion']) ?>" required>
          </div>
          
          <div class="form-group">
            <label for="estado">Estado *</label>
            <select id="estado" name="estado" class="form-control" required>
              <option value="1" <?= ($rack['Estado'] == 1) ? 'selected' : '' ?>>Activo</option>
              <option value="0" <?= ($rack['Estado'] == 0) ? 'selected' : '' ?>>Inactivo</option>
            </select>
          </div>
          
          <div class="form-actions">
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save"></i> Actualizar Rack
            </button>
            <a href="<?= site_url('dispositivo') ?>" class="btn btn-secondary">
              <i class="fas fa-times"></i> Cancelar
            </a>
          </div>
        </form>

        <!-- Sección para eliminar el rack -->
        <div class="delete-section">
          <h3>Zona de peligro</h3>
          <p>Esta acción no se puede deshacer. Se eliminará permanentemente el rack y todos los dispositivos asociados.</p>
          <br>
          <button type="button" class="btn btn-danger" onclick="confirmarEliminacion()">
            <i class="fas fa-trash"></i> Eliminar Rack
          </button>
        </div>
      </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    <div id="modalConfirmacion" class="modal">
      <div class="modal-content">
        <h3>¿Estás seguro de que deseas eliminar este rack?</h3>
        <p>Esta acción eliminará permanentemente el rack "<?= esc($rack['Ubicacion']) ?>" y todos los dispositivos asociados. Esta acción no se puede deshacer.</p>
        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>
          <a href="<?= site_url('eliminar-rack/'.$rack['ID_Rack']) ?>" class="btn btn-danger">Sí, eliminar</a>
        </div>
      </div>
    </div>

    <script>
      // Mostrar/ocultar sidebar en móviles
      const menuToggle = document.getElementById('menuToggle');
      const sidebar = document.getElementById('sidebar');
      
      menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
      });

      // Cerrar sidebar al hacer clic en enlace (en móviles)
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
        if(confirm('¿Estás seguro de que deseas cerrar sesión?')){
          window.location.href=url;
        }
      }

      // Redimensionar la ventana
      window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
          sidebar.classList.remove('active');
        }
      });

      // Funciones para el modal de confirmación de eliminación
      function confirmarEliminacion() {
        document.getElementById('modalConfirmacion').style.display = 'flex';
      }

      function cerrarModal() {
        document.getElementById('modalConfirmacion').style.display = 'none';
      }

      // Cerrar modal al hacer clic fuera del contenido
      window.addEventListener('click', function(event) {
        const modal = document.getElementById('modalConfirmacion');
        if (event.target === modal) {
          cerrarModal();
        }
      });
    </script>
  </body>
</html>