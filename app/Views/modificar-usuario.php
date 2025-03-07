<?php

    $session = session();
    $rol = $session->get("ID_Rol");

?>

<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/mod1.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    /* Contenedor de la tabla */
/* Contenedor del título */
.titulo {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px 270px 10px; /* Alineación con el sidebar */
    text-align: center;
}

/* Título principal */
.titulo h1 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

/* Contenedor de acciones (botón + barra de búsqueda) */
.titulo .acciones {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-top: 10px;
}

/* Botón "Añadir Usuario" */
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
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

.barra-busqueda:focus {
    border-color: #3498db;
    outline: none;
}

/* Tabla */
.tabla-container {
    padding-left: 270px; /* Alineación con el sidebar */
    padding-right: 20px;
    overflow-x: auto;
}

.modificar {
    margin: 20px auto;
    width: calc(100% - 270px);
    border-collapse: collapse;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Ajustes visuales para tabla y filas ya se mantienen del CSS original */


.modificar th,
.modificar td {
    padding: 10px 15px;
    text-align: center;
    border: 1px solid #ddd;
}

.modificar th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #333;
}

.modificar tr:nth-child(even) {
    background-color: #f7f7f7;
}

.modificar tr:hover {
    background-color: #e9f5ff;
}

/* Roles */
.rol-admin {
    color: #0066cc;
    font-weight: bold;
}

.rol-supervisor {
    color: #e67e22;
    font-weight: bold;
}

.rol-usuario {
    color: #27ae60;
}

.rol-desconocido {
    color: #7f8c8d;
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
}

.btn-modificar:hover {
    background-color: #2980b9;
}

.btn-eliminar {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-eliminar:hover {
    background-color: #c0392b;
}
/* Estilos para el Sidebar */
.sidebar {
    height: 100vh;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background: linear-gradient(180deg, #000706, #00272d); /* Gradiente de color1 a color2 */
    padding-top: 20px;
    font-family: Arial, sans-serif;
    color: #bfac8b; /* Color5 para el texto */
    transition: background 1.5s ease-in-out, width 0.5s ease-in-out;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5); /* Sombra más pronunciada */
    overflow-y: auto; /* Desplazamiento vertical */
    scrollbar-width: none; /* Ocultar barra de desplazamiento en Firefox */
}

.sidebar::-webkit-scrollbar {
    display: none; /* Ocultar barra de desplazamiento en Chrome/Safari */
}

.sidebar:hover {
    width: 270px;
    background: linear-gradient(180deg, #00272d, #134647); /* Gradiente más sutil */
    box-shadow: 2px 0 15px rgba(0, 0, 0, 0.6); /* Sombra más fuerte en hover */
}

.sidebar a {
    padding: 15px;
    text-decoration: none;
    font-size: 18px;
    color: #bfac8b; /* Color5 */
    display: flex;
    align-items: center;
    border-radius: 8px;
    margin: 10px 15px;
    background-color: rgba(255, 255, 255, 0.05);
    transition: all 0.4s ease; /* Transiciones más suaves */
    box-shadow: inset 0 0 0 rgba(0, 0, 0, 0.1);
}

.sidebar a:hover {
    background-color: #0c7e7e; /* Color4 */
    color: #fff; /* Blanco en hover */
    transform: translateX(12px);
    box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.3), inset 0 0 10px rgba(0, 0, 0, 0.2);
}

.sidebar a i {
    margin-right: 12px;
    font-size: 20px;
    color: #bfac8b; /* Color5 para íconos */
    transition: color 0.3s ease;
}

.sidebar a:hover i {
    color: #fff; /* Íconos blancos en hover */
}

.sidebar .logo {
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #bfac8b; /* Color5 */
    animation: fadeIn 1.5s ease-in-out;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
}

.sidebar .menu-heading {
    padding-left: 15px;
    text-transform: uppercase;
    font-weight: bold;
    margin-top: 25px;
    font-size: 15px;
    color: #bfac8b; /* Color5 */
    border-bottom: 1px solid #bfac8b;
    padding-bottom: 8px;
    animation: fadeIn 1.5s ease-in-out;
}

.sidebar .menu-heading:last-of-type {
    margin-top: 40px; /* Separación extra para la última categoría */
}

.sidebar a:last-of-type {
    margin-bottom: 30px; /* Espacio en la parte inferior del último enlace */
}
.sidebar .menu .cerrar-sesion {
    margin-top: auto; /* Esto empuja el elemento hacia el fondo del sidebar */
    padding-bottom: 10px; /* Puedes ajustar el espacio adicional si es necesario */
}
.sidebar .logout {
    position: absolute;
    bottom: 20px;
    width: 100%;
    text-align: center;
}

.sidebar .logout a {
    transition: transform 0.3s ease, color 0.3s ease;
}

.sidebar .logout a:hover {
    color: #fff;
    transform: scale(1.1); /* Pequeño aumento en hover */
}

/* Enlace activo */
.sidebar a.active {
    background-color: #bfac8b; /* Color5 para el enlace activo */
    color: #000706; /* Texto color1 */
}

/* Animaciones */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>
</head>
<body>
  <!-- Modal de confirmación -->
<div id="modalConfirmacion" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="background: #fff; padding: 20px; border-radius: 8px; width: 300px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <h3 style="margin-bottom: 20px;">¿Quieres borrar este usuario?</h3>
        <form id="formEliminar" method="post" action="<?= site_url('eliminar-usuarios') ?>">
            <input type="hidden" name="id" id="idUsuarioEliminar">
            <button type="button" onclick="cerrarModal()" style="background: #ccc; border: none; padding: 10px 20px; border-radius: 4px; margin-right: 10px;">Cancelar</button>
            <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 10px 20px; border-radius: 4px;">Eliminar</button>
        </form>
    </div>
</div>
<!-- Incluir Sidebar -->
<div class="sidebar">
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
  <!-- Opciones para Administrador -->
<?php if ($rol == 5): ?>
  <div class="menu-heading">Usuarios</div>
  <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item">
    <i class="fas fa-user-edit"></i> Gestor de Tarjetas
  </a>
<?php endif; ?>
<!-- Opciones para Tarjetas disponibles para todos los roles -->
<div class="menu-heading">Tarjetas</div>
<!-- Administrador puede gestionar tarjetas -->
<?php if ($rol == 5): ?>
  <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item"> <!-- Cambia "1" por el ID dinámico -->
    <i class="fas fa-user-edit"></i> Gestor de Tarjetas
  </a>
<?php endif; ?>
<!-- Consultar estado de tarjetas, accesible para todos los roles -->
<a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item">
  <i class="fas fa-search"></i> Consultar Estado de Tarjetas
</a>
<!-- Opciones para Supervisor y Administrador -->
<?php if ($rol == 5 || $rol == 6): ?>
  <div class="menu-heading">Reportes</div>
  <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item">
    <i class="fas fa-exclamation-triangle"></i> Ver Alertas
  </a>
  <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item">
    <i class="fas fa-key"></i> Ver Accesos de Tarjeta
  </a>
  <a href="<?php echo site_url('/ver-historial-cambios');?>" class="menu-item">
    <i class="fas fa-history"></i> Ver Historial de Cambios
  </a>
<?php endif; ?>

<!-- Nueva Categoría para Cerrar Sesión -->
<div class="menu-heading">Cerrar Sesión</div>
<a onclick="cerrarsesion('<?php echo site_url('/logout');?>')" class="menu-item">
  <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
</a>

</div>
<!-- Fin Sidebar -->
<div class="titulo">
  <h1>Administración de Usuarios</h1>
  <div class="acciones">
    <a href="<?php echo site_url('/register'); ?>" class="menu-item">
      <i class="fas fa-id-card"></i> Añadir Usuario
    </a>
    <input type="text" placeholder="Buscar usuario..." class="barra-busqueda">
  </div>
</div>
<div class="tabla-container">
    <table class="modificar">
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
                        case 5: // Administrador
                            $rolNombre = "Administrador";
                            $rolClase = "rol-admin";
                            break;
                        case 6: // Supervisor
                            $rolNombre = "Supervisor";
                            $rolClase = "rol-supervisor";
                            break;
                        case 7: // Usuario
                            $rolNombre = "Usuario";
                            $rolClase = "rol-usuario";
                            break;
                        default:
                            $rolNombre = "Desconocido";
                            $rolClase = "rol-desconocido";
                    }
                    ?>
                    <span class="<?php echo $rolClase; ?>"><?php echo $rolNombre; ?></span>
                </td>
                <td><?php echo $u["ID_Tarjeta"]; ?></td>
                <td>
                    <form action="<?= site_url('modificar-usuario2') ?>" method="post">
                        <input type="hidden" value="<?php echo $u["ID_Usuario"]; ?>" name="id">
                        <input type="submit" value="Modificar" class="btn-modificar">
                    </form>
                    <button type="button" class="btn-eliminar" onclick="mostrarModal(<?php echo $u['ID_Usuario']; ?>)">
                        Eliminar
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function mostrarModal(idUsuario) {
        // Establecer el ID del usuario en el formulario
        document.getElementById('idUsuarioEliminar').value = idUsuario;
        // Mostrar el modal
        document.getElementById('modalConfirmacion').style.display = 'flex';
    }

    function cerrarModal() {
        // Ocultar el modal
        document.getElementById('modalConfirmacion').style.display = 'none';
    }
</script>

<script>
function cerrarsesion(url){
  if(confirm('¿Seguro Queres Cerrar Sesion?')){
    window.location.href=url;
  }
}
</script>
</body>
</html>

<?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    } elseif (isset($success)) {
        echo "<p style='color: green;'>$success</p>";
    }
?>

 
