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

    /* Tabla de historial */
    .historial-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 30px;
    }

    .historial-table {
        width: 100%;
        border-collapse: collapse;
    }

    .historial-table th {
        background-color: #3498db;
        color: white;
        padding: 12px 15px;
        text-align: left;
    }

    .historial-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
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
        }
        
        .menu-toggle {
            display: block;
        }
        
        .historial-container {
            margin: 0 10px;
        }
    }

    @media (max-width: 768px) {
        .historial-table {
            display: block;
            overflow-x: auto;
        }
        
        .titulo h1 {
            font-size: 24px;
        }
        
        .modal-content {
            width: 95%;
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
        
        .mensaje {
            margin: 15px 10px;
            font-size: 14px;
        }
        
        .titulo h1 {
            font-size: 22px;
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
    <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item">
      <i class="fas fa-key"></i> Ver Accesos
    </a>
    <a href="<?php echo site_url('/historial-cambios');?>" class="menu-item active">
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
      <h1>Historial de Cambios</h1>
    </div>
    
    <div class="historial-container">
      <?php if (!empty($archivos)): ?>
        <table class="historial-table">
          <thead>
            <tr>
              <th>Archivo</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($archivos as $archivo): ?>
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
        <p>No hay registros de cambios disponibles</p>
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
          alert("Error al cargar el contenido del archivo.");
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