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
        background-color: #f8f9fa; /* Color de fondo general */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
      }

      /* Botón para mostrar/ocultar menú en móviles */
      .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        background-color: #2c3e50; /* Color de fondo del sidebar */
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
        background-color: #2c3e50; /* Color de fondo del sidebar */
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
        color: #ecf0f1; /* Color de texto para ítems del menú */
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
        background-color: #34495e; /* Color de fondo al pasar el mouse */
        transform: translateX(5px);
      }

      /* Efecto para íconos */
      .sidebar a i {
        margin-right: 12px;
        font-size: 16px;
        color: #3498db; /* Color de los íconos */
        transition: all 0.3s ease;
        width: 20px;
        text-align: center;
      }

      .sidebar a:hover i {
        color: #ecf0f1;
      }

      /* Elemento activo */
      .sidebar a.active {
        background-color: #3498db; /* Color de fondo para el ítem activo */
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

      /* Contenedor principal de la tabla */
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

      /* Tabla de accesos */
      .access-table { /* Renombrado para consistencia */
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      .access-table th,
      .access-table td {
        padding: 12px 15px;
        text-align: left; /* Alineación a la izquierda por defecto para datos */
        border-bottom: 1px solid #eee;
      }

      .access-table th {
        background-color: #f8f9fa;
        font-weight: bold;
        color: #2c3e50;
      }

      .access-table tr:nth-child(even) {
        background-color: #f8f9fa;
      }

      .access-table tr:hover {
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
        margin-top: 30px; /* Mayor separación */
        flex-wrap: wrap;
        gap: 8px; /* Espacio entre botones */
      }

      .paginacion a,
      .paginacion span {
        padding: 10px 16px; /* Aumentado padding */
        text-decoration: none;
        border-radius: 6px; /* Bordes más redondeados */
        transition: all 0.3s ease;
        font-size: 14px;
        min-width: 40px; /* Ancho mínimo para botones */
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }

      .paginacion a {
        background-color: #3498db;
        color: white;
      }

      .paginacion a:hover {
        background-color: #2980b9;
        transform: translateY(-2px); /* Efecto ligero al pasar el mouse */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }

      .paginacion a.activa {
        background-color: #2980b9;
        font-weight: bold;
        cursor: default; /* No cambia el cursor para la página activa */
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.2);
      }

      .paginacion span { /* Estilo para los puntos suspensivos */
        background-color: transparent;
        color: #555;
        cursor: default;
        font-weight: bold;
      }

      /* ====== TABLA ====== */
      table {
        width: 100%;
        border-collapse: collapse;
      }
      table, th, td {
        border: 1px solid #ddd;
      }
      th, td {
        padding: 8px;
        text-align: center;
      }
      td img {
        cursor: pointer;
        border-radius: 4px;
        transition: transform 0.2s;
      }
      td img:hover {
        transform: scale(1.05);
      }

      /* ====== MODAL MEJORADO ====== */
      .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.9);
        z-index: 99999 !important;
        overflow: auto;
      }

      .modal-content {
        position: relative;
        margin: 40px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: auto;
        max-width: 90%;
        text-align: center;
        box-shadow: 0 5px 30px rgba(0,0,0,0.5);
        animation: fadeIn 0.3s;
        z-index: 100000 !important;
      }

      .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
      }

      .modal-title {
        font-size: 1.5rem;
        color: #2c3e50;
        font-weight: bold;
      }

      .close {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
        transition: color 0.3s;
      }
      .close:hover {
        color: #e74c3c;
      }

      .modal-image-container {
        max-height: 70vh;
        overflow: hidden;
        border-radius: 6px;
      }

      .modal-image {
        max-width: 100%;
        max-height: 70vh;
        object-fit: contain;
      }

      @keyframes fadeIn {
        from {opacity: 0; transform: scale(0.9);}
        to {opacity: 1; transform: scale(1);}
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

        .admin-container {
          padding: 20px;
        }

        .admin-header {
          flex-direction: column;
          align-items: flex-start;
          gap: 10px;
        }
        
        .access-table th, 
        .access-table td {
          padding: 10px 12px;
          font-size: 14px;
        }

        .modal-content {
          margin: 20px auto;
          padding: 15px;
        }
      }

      @media (max-width: 768px) {
        /* Permite scroll horizontal en tablas pequeñas si el contenido es demasiado ancho */
        .admin-container {
            overflow-x: auto;
        }
        .access-table {
            min-width: 600px; /* Define un ancho mínimo para que la tabla no se colapse demasiado */
        }
        
        .admin-header h1 {
          font-size: 24px;
        }

        .modal-title {
          font-size: 1.3rem;
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        .sidebar a {
          padding: 10px 12px;
          font-size: 14px;
        }
        
        .sidebar .logo {
          font-size: 20px;
        }
        
        .admin-header h1 {
          font-size: 22px;
        }
        
        .access-table th, 
        .access-table td {
          padding: 8px 10px;
          font-size: 13px;
        }
        
        .paginacion a,
        .paginacion span {
          padding: 8px 12px;
          font-size: 13px;
        }

        .modal-content {
          padding: 10px;
        }

        .modal-title {
          font-size: 1.2rem;
        }
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
      <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item active">
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
                <h1>Registros de Accesos</h1>
                <!-- No hay acciones de búsqueda/añadir en esta vista, por lo que no se incluye admin-actions aquí -->
            </div>
            
            <!-- Modal para mostrar la imagen por encima de la tabla -->
            <div id="fotoModal" class="modal">
              <div class="modal-content">
                <div class="modal-header">
                  <h2 class="modal-title">Imagen de Acceso</h2>
                  <span class="close" onclick="cerrarModal()">&times;</span>
                </div>
                <div class="modal-image-container">
                  <img id="imagenModal" class="modal-image" src="">
                </div>
              </div>
            </div>
            
            <div class="tabla-container">
          <table class="access-table">
              <thead>
                  <tr>
                      <th>Fecha y Hora</th>
                      <th>Resultado</th>
                      <th>ID Tarjeta</th>
                      <th>Foto</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($registros as $registro): ?>
                  <tr>
                      <td><?= esc($registro['Fecha_Hora']); ?></td>
                      <td class="<?= $registro['Resultado'] == 1 ? 'acceso-permitido' : 'acceso-bloqueado'; ?>">
                          <?= $registro['Resultado'] == 1 ? 'Permitido' : 'Bloqueado'; ?>
                      </td>
                      <td><?= esc($registro['ID_Tarjeta']); ?></td>
                      <td>
                        <?php if (!empty($registro['Archivo_Video'])): ?>
                            <img src="<?= base_url('writable/uploads/fotos/' . esc($registro['Archivo_Video'])); ?>" 
                                 alt="Foto registro" width="100" height="80"
                                 onclick="abrirModal(this)">
                       <?php else: ?>
                            <span>Sin foto</span>
                        <?php endif; ?>
                      </td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>
      </div>
            <?php if (isset($totalPaginas) && $totalPaginas > 1): ?>
                <div class="paginacion">
                    <?php 
                    // Mostrar botón para página anterior
                    if ($paginaActual > 1): ?>
                        <a href="?pagina=<?= $paginaActual - 1; ?>">‹ Anterior</a>
                    <?php endif; ?>
                    
                    <?php 
                    // Lógica para mostrar las páginas, manteniendo un rango visible
                    $startPage = max(1, $paginaActual - 2);
                    $endPage = min($totalPaginas, $paginaActual + 2);

                    if ($startPage > 1) {
                        echo '<a href="?pagina=1">1</a>';
                        if ($startPage > 2) {
                            echo '<span>...</span>';
                        }
                    }

                    for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <a href="?pagina=<?= $i; ?>" class="<?= $i == $paginaActual ? 'activa' : ''; ?>"><?= $i; ?></a>
                    <?php endfor; 
                    
                    if ($endPage < $totalPaginas) {
                        if ($endPage < $totalPaginas - 1) {
                            echo '<span>...</span>';
                        }
                        echo '<a href="?pagina=' . $totalPaginas . '">' . $totalPaginas . '</a>';
                    }
                    ?>
                    
                    <?php 
                    // Mostrar botón para página siguiente
                    if ($paginaActual < $totalPaginas): ?>
                        <a href="?pagina=<?= $paginaActual + 1; ?>">Siguiente ›</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
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

      // Funciones para el modal de imagen
      function abrirModal(img) {
        document.getElementById("fotoModal").style.display = "block";
        document.getElementById("imagenModal").src = img.src;
        
        // Desplazar la página hacia arriba para mostrar el modal
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      function cerrarModal() {
        document.getElementById("fotoModal").style.display = "none";
      }

      // Cierra si haces clic fuera del modal
      window.onclick = function(event) {
        var modal = document.getElementById("fotoModal");
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }

      // Cierra el modal con la tecla Escape
      document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
          cerrarModal();
        }
      });
    </script>
</body>
</html>