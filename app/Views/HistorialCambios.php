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

// Obtener la lista de archivos en el directorio de cambios (orden descendente)
$directorio = WRITEPATH . 'logs/cambios/';
if (!is_dir($directorio)) {
    mkdir($directorio, 0755, true);
}
$archivos = array_diff(scandir($directorio, SCANDIR_SORT_DESCENDING), array('.', '..'));

// --- Lógica de paginación ---
$itemsPerPage = 10;
$totalArchivos = count($archivos);
$totalPaginas = ceil($totalArchivos / $itemsPerPage);

// Obtener la página actual de la URL, si no está presente, usar 1
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
// Asegurarse de que la página actual sea válida
if ($paginaActual < 1) {
    $paginaActual = 1;
} elseif ($paginaActual > $totalPaginas && $totalPaginas > 0) {
    $paginaActual = $totalPaginas;
} elseif ($totalPaginas == 0) {
    $paginaActual = 1; // Si no hay archivos, la página es 1
}

// Calcular el índice de inicio y fin para la porción de archivos de la página actual
$startIndex = ($paginaActual - 1) * $itemsPerPage;
$archivosPagina = array_slice($archivos, $startIndex, $itemsPerPage);

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Cambios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

      /* Contenedor principal de la tabla (adaptado para historial) */
      .admin-container { /* Usamos esta clase para el contenedor principal de la vista */
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
      }

      .admin-header { /* Encabezado dentro del contenedor principal */
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

      /* Tabla de historial */
      .historial-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px; /* Separación del encabezado */
      }

      .historial-table th {
        background-color: #f8f9fa; /* Color de fondo del th, como en las otras tablas */
        font-weight: bold;
        color: #2c3e50; /* Color de texto del th */
        padding: 12px 15px;
        text-align: left;
      }

      .historial-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        text-align: left; /* Alineación por defecto para el contenido de la tabla */
      }

      .historial-table tr:nth-child(even) {
        background-color: #f8f9fa;
      }

      .historial-table tr:hover {
        background-color: #f1f8ff;
      }

      /* Botones */
      .btn-ver {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        display: inline-flex; /* Para alinear el icono y el texto */
        align-items: center;
        gap: 5px; /* Espacio entre icono y texto */
      }

      .btn-ver:hover {
        background-color: #2980b9;
      }

      /* Modal */
      .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
        z-index: 1100;
      }

      .modal-content {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        width: 80%;
        max-width: 800px;
        max-height: 80vh;
        overflow: auto;
        padding: 20px;
        position: relative;
      }

      .modal-close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        color: #777;
        cursor: pointer;
      }

      .modal-close:hover {
        color: #333;
      }

      .modal-pre {
        background-color: #f5f5f5;
        padding: 15px;
        border-radius: 4px;
        font-family: monospace;
        white-space: pre-wrap;
        word-wrap: break-word;
        margin-top: 15px;
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


      /* Media Queries para responsive */
      @media (max-width: 992px) {
        .sidebar {
          transform: translateX(-100%);
        }
        
        .sidebar.active {
          transform: translateX(0);
        }
        
        .content, .mensaje {
          margin-left: 0;
          padding: 20px;
        }
        
        .menu-toggle {
          display: block;
        }
        
        .admin-container {
          margin: 20px;
          padding: 20px;
        }

        .admin-header {
          flex-direction: column;
          align-items: flex-start;
          gap: 10px;
        }
      }

      @media (max-width: 768px) {
        .historial-table {
          display: block;
          overflow-x: auto;
          white-space: nowrap; /* Permite el scroll horizontal */
          min-width: 600px; /* Asegura un ancho mínimo para la tabla */
        }
        
        .admin-header h1 {
          font-size: 24px;
        }
        
        .modal-content {
          width: 95%;
          padding: 15px; /* Reducir padding en móviles */
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
        
        .mensaje {
          margin: 15px 10px;
          font-size: 14px;
        }
        
        .admin-header h1 {
          font-size: 20px;
        }
        
        .historial-table th, 
        .historial-table td {
          padding: 10px 12px;
          font-size: 14px;
        }
        
        .btn-ver {
          padding: 6px 10px;
          font-size: 13px;
        }
        .alerta-icon { /* Aplicado de la vista de alertas para el botón "Ver" */
            font-size: 18px; 
            margin-right: 5px; /* Ajuste para el botón */
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
      <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item">
        <i class="fas fa-door-open"></i> Accesos
      </a>
      <a href="<?php echo site_url('/historial-cambios');?>" class="menu-item active">
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
                <h1>Historial de Cambios</h1>
            </div>
            
            <div class="tabla-container"> <!-- Contenedor para tabla, necesario para overflow-x -->
                <?php if (!empty($archivosPagina)): /* Cambiado de $archivos a $archivosPagina */ ?>
                    <table class="historial-table">
                        <thead>
                            <tr>
                                <th>Archivo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($archivosPagina as $archivo): /* Cambiado de $archivos a $archivosPagina */ ?>
                                <tr>
                                    <td><?= esc($archivo); ?></td>
                                    <td>
                                        <button class="btn-ver" onclick="verContenido('<?= esc($archivo); ?>')">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="no-alertas">No hay registros de cambios disponibles</p>
                <?php endif; ?>
            </div>

            <?php if ($totalPaginas > 1): ?>
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

    <!-- Modal para mostrar contenido -->
    <div id="modal" class="modal">
      <div class="modal-content">
        <span class="modal-close" onclick="cerrarModal()">&times;</span>
        <h3>Detalles del Cambio</h3>
        <pre class="modal-pre" id="contenido"></pre>
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

      // Funciones para el modal
      function verContenido(archivo) {
        $.ajax({
          url: "<?= site_url('historial-cambios/ver'); ?>",
          method: "POST",
          data: { nombreArchivo: archivo },
          success: function(data) {
            $("#contenido").text(data);
            $("#modal").css("display", "flex");
          },
          error: function() {
            // Reemplazar alert() con una función de mensaje personalizada o un modal de error
            console.error("Error al cargar el contenido del archivo.");
            // Implementa tu propia función para mostrar mensajes al usuario sin alert()
            // Por ejemplo: showCustomMessage('Error al cargar el contenido del archivo.', 'error');
          }
        });
      }

      function cerrarModal() {
        $("#modal").hide();
      }

      // Cerrar modal al hacer clic fuera del contenido
      window.onclick = function(event) {
        const modal = document.getElementById('modal');
        if (event.target == modal) {
          cerrarModal();
        }
      }
    </script>
</body>
</html>