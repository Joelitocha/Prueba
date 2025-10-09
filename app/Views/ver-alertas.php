<?php
$session = session();
$rol = $session->get("ID_Rol");

// Verificar si el usuario tiene permiso para entrar a la vista (SOLO ADMIN y SUPERVISOR)
if (!isset($session)) {
    $session = session();
}
if ($session->get("ID_Rol") != 5 && $session->get("ID_Rol") != 6) {
    echo "No tienes permiso para entrar en esta vista";
    exit;
}
?>
<?php use CodeIgniter\Pager\PagerRenderer; ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ver Alertas</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; }

  /* Sidebar */
  .menu-toggle { display: none; position: fixed; top: 15px; left: 15px; background-color: #2c3e50; color: white; border: none; border-radius: 4px; padding: 10px 15px; z-index: 1100; cursor: pointer; font-size: 18px; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
  .sidebar { height: 100vh; width: 250px; position: fixed; top: 0; left: 0; background-color: #2c3e50; padding-top: 20px; color: #fff; box-shadow: 2px 0 15px rgba(0,0,0,0.1); overflow-y: auto; scrollbar-width: none; z-index: 1000; transition: transform 0.3s ease; }
  .sidebar::-webkit-scrollbar { display: none; }
  .sidebar a { padding: 12px 20px; text-decoration: none; font-size: 15px; color: #ecf0f1; display: flex; align-items: center; margin: 5px 10px; border-radius: 4px; transition: all 0.3s ease; position: relative; overflow: hidden; }
  .sidebar a:hover { background-color: #34495e; transform: translateX(5px); }
  .sidebar a i { margin-right: 12px; font-size: 16px; color: #3498db; transition: all 0.3s ease; width: 20px; text-align: center; }
  .sidebar a:hover i { color: #ecf0f1; }
  .sidebar a.active { background-color: #3498db; color: white; }
  .sidebar a.active i { color: white; }
  .sidebar .logo { text-align: center; font-size: 22px; font-weight: bold; margin-bottom: 30px; color: #ecf0f1; padding: 0 15px; display: flex; flex-direction: column; align-items: center; }
  .sidebar .logo .role { font-size: 14px; margin-top: 5px; color: #bdc3c7; font-weight: normal; }
  .sidebar .menu-heading { padding: 10px 20px; text-transform: uppercase; font-weight: bold; margin-top: 20px; font-size: 12px; color: #bdc3c7; letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); }

  /* Contenido */
  .content { margin-left: 250px; padding: 30px; transition: margin-left 0.3s ease; min-height: 100vh; }
  .admin-container { background-color: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-bottom: 30px; }
  .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
  .admin-header h1 { font-size: 24px; color: #2c3e50; margin: 0; }

  /* Filtros */
  .alerta-filtros { margin-bottom: 20px; display: flex; flex-wrap: wrap; gap: 10px; }
  .filtro-btn { padding: 8px 15px; background-color: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; transition: all 0.3s ease; font-size: 14px; }
  .filtro-btn:hover { background-color: #2980b9; }
  .filtro-btn.active { background-color: #000000; }

  /* Alertas */
  .alertas-list { list-style: none; padding: 0; margin: 0; }
  .alerta-item { padding: 15px 20px; border-bottom: 1px solid #eee; transition: background-color 0.3s; }
  .alerta-item:hover { background-color: #f9f9f9; }
  .alerta-item:last-child { border-bottom: none; }
  .alerta-content { display: flex; align-items: flex-start; }
  .alerta-icon { margin-right: 15px; color: #e74c3c; font-size: 24px; }
  .alerta-text { flex: 1; }
  .alerta-title { font-weight: 600; color: #333; margin-bottom: 5px; font-size: 16px; }
  .alerta-details { display: flex; justify-content: space-between; color: #777; font-size: 14px; flex-wrap: wrap; }
  .alerta-time { color: #95a5a6; }
  .no-alertas { padding: 30px; text-align: center; color: #95a5a6; font-size: 16px; }

  /* Mensajes */
  .mensaje { padding: 12px 15px; margin: 15px 20px 15px 270px; border-radius: 4px; text-align: center; font-size: 15px; transition: margin-left 0.3s ease; }
  .error { color: #e74c3c; background-color: #fdecea; border: 1px solid #f5c6cb; }
  .success { color: #27ae60; background-color: #e8f5e9; border: 1px solid #c3e6cb; }

  @media (max-width: 992px) {
    .sidebar { transform: translateX(-100%); }
    .sidebar.active { transform: translateX(0); }
    .content, .mensaje { margin-left: 0; padding: 20px; }
    .menu-toggle { display: block; }
    .admin-container { margin: 20px; padding: 20px; }
    .admin-header { flex-direction: column; align-items: flex-start; gap: 10px; }
  }
  @media (max-width: 768px) { .alerta-details { flex-direction: column; align-items: flex-start; gap: 5px; } }
  @media (max-width: 576px) {
    .sidebar { width: 220px; }
    .sidebar a { padding: 10px 12px; font-size: 14px; }
    .sidebar .logo { font-size: 20px; }
    .mensaje { margin: 15px 10px; font-size: 14px; }
    .alerta-item { padding: 12px 15px; }
    .alerta-icon { font-size: 20px; margin-right: 10px; }
    .alerta-title { font-size: 15px; }
    .alerta-details { font-size: 13px; }
    .admin-header h1 { font-size: 20px; }
  }

  /* Estilos para la tabla de alertas */
.alertas-table-container {
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

.alerta-filtros {
  display: flex;
  gap: 10px;
  align-items: center;
  flex-wrap: wrap;
}

.filtro-btn {
  background-color: #f8f9fa;
  color: #2c3e50;
  border: 1px solid #ddd;
  padding: 8px 15px;
  border-radius: 6px;
  font-size: 14px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.filtro-btn:hover,
.filtro-btn.active {
  background-color: #3498db;
  color: white;
  border-color: #3498db;
}

.alertas-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.alertas-table th, 
.alertas-table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

.alertas-table th {
  background-color: #f8f9fa;
  font-weight: bold;
  color: #2c3e50;
}

.alertas-table tr:nth-child(even) {
  background-color: #f8f9fa;
}

.alertas-table tr:hover {
  background-color: #f1f8ff;
}

.id-column {
  width: 80px;
  text-align: center;
  font-weight: 600;
  color: #2c3e50;
}

.date-column {
  width: 180px;
  color: #666;
}

.rack-column {
  width: 120px;
  text-align: center;
}

.rack-id {
  display: inline-block;
  background-color: #e3f2fd;
  color: #1565c0;
  padding: 5px 12px;
  border-radius: 20px;
  font-weight: 600;
  font-size: 14px;
}

.no-alertas {
  text-align: center;
  padding: 40px;
  color: #777;
  font-style: italic;
  background-color: #f8f9fa;
  border-radius: 8px;
  margin-top: 20px;
}

/* Media Queries para responsive */
@media (max-width: 992px) {
  .alertas-table-container {
    padding: 20px;
  }
  
  .admin-header {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .alerta-filtros {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 768px) {
  .alertas-table th,
  .alertas-table td {
    padding: 10px 12px;
    font-size: 14px;
  }
  
  .id-column, 
  .date-column, 
  .rack-column {
    width: auto;
  }
  
  .alertas-table {
    display: block;
    overflow-x: auto;
  }
}

@media (max-width: 576px) {
  .alertas-table-container {
    padding: 15px;
  }
  
  .alertas-table th,
  .alertas-table td {
    padding: 8px 10px;
    font-size: 13px;
  }
  
  .filtro-btn {
    padding: 6px 10px;
    font-size: 13px;
  }
}
</style>
<!--Estilo para la paginación-->
<style>
  .pagination {
  display: inline-block;
  margin-top: 20px;
}

.pagination li {
  display: inline;
  margin: 0 4px;
}

.pagination a, .pagination span {
  color: #3498db;
  padding: 8px 12px;
  text-decoration: none;
  border: 1px solid #ddd;
  border-radius: 4px;
  transition: background-color 0.3s;
}

.pagination a:hover {
  background-color: #3498db;
  color: white;
}

.pagination .active span {
  background-color: #3498db;
  color: white;
  border-color: #3498db;
}

</style>
</head>
<body>

<button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i> Menú</button>

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

<div class="content">
  <div class="admin-container">
    <div class="admin-header">
      <h1>Alertas del Sistema</h1>
      <div class="alerta-filtros">
        <button class="filtro-btn active" data-tipo="todas">Todas</button>
        <button class="filtro-btn" data-tipo="hardware">Hardware</button>
        <button class="filtro-btn" data-tipo="software">Software</button>
        <button class="filtro-btn" data-tipo="acceso">Acceso</button>
        <button class="filtro-btn" data-tipo="sistema">Sistema</button>
      </div>
    </div>

    <div class="alertas-table-container">
            <?php if (isset($alertas) && !empty($alertas)): ?>
                <table class="alertas-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>ID Rack</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alertas as $alerta): ?>
                            <tr>
                                <td class="id-column"><?= esc($alerta['id_alerta']); ?></td>
                                <td class="date-column"><?= date('d/m/Y H:i', strtotime($alerta['fecha'])); ?></td>
                                <td class="rack-column"><span class="rack-id"><?= esc($alerta['id_rack']); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (isset($pager)) : ?>
                  <div style="text-align:center; margin-top: 20px;">
                      <?= $pager->links() ?>
                  </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="no-alertas"><p>No hay alertas registradas en el sistema</p></div>
            <?php endif; ?>
        </div>
    </div>
  </div>
</div>

<script>
  // Filtros
  const botonesFiltro = document.querySelectorAll('.filtro-btn');
  const alertasItems = document.querySelectorAll('.alerta-item');
  botonesFiltro.forEach(boton => {
      boton.addEventListener('click', () => {
          botonesFiltro.forEach(b => b.classList.remove('active'));
          boton.classList.add('active');
          const tipoSeleccionado = boton.getAttribute('data-tipo');
          alertasItems.forEach(item => {
              if (tipoSeleccionado === 'todas' || item.getAttribute('data-tipo') === tipoSeleccionado) {
                  item.style.display = '';
              } else { item.style.display = 'none'; }
          });
      });
  });

  // Sidebar
  const menuToggle = document.getElementById('menuToggle');
  const sidebar = document.getElementById('sidebar');
  menuToggle.addEventListener('click', () => { sidebar.classList.toggle('active'); });
  const menuItems = document.querySelectorAll('.sidebar a');
  menuItems.forEach(item => { item.addEventListener('click', () => { if(window.innerWidth <= 992) sidebar.classList.remove('active'); }); });
  window.addEventListener('resize', () => { if(window.innerWidth > 992) sidebar.classList.remove('active'); });

  // Cerrar sesión
  function cerrarsesion(url){
    if(confirm('¿Estás seguro de que deseas cerrar sesión?')){
      window.location.href=url;
    }
  }
</script>

</body>
</html>
