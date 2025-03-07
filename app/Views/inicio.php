<?php

    $session = session();
    $rol = $session->get("ID_Rol");

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
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

/* Estilos para el contenido fuera del sidebar */
.content {
    margin-left: 250px;
    padding: 20px;
    transition: all 0.3s ease-in-out;
}

body {
    background-image: url("../images/bg1.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed; /* Fija el fondo para evitar que se mueva con el contenido */
}

/* Estilos para el contenedor principal */
.welcome-container {
    background: linear-gradient(135deg, #00272d, #0c7e7e); /* Gradiente de color2 a color4 */
    padding: 50px;
    border-radius: 20px;
    max-width: 800px;
    margin: 50px auto;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3); /* Sombra más fuerte */
}

/* Estilos para la carta de bienvenida */
.welcome-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
    font-family: 'Arial', sans-serif;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.welcome-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

/* Estilo para el título de la carta */
.welcome-header h1 {
    font-size: 30px;
    color: #bfac8b; /* Color5 */
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1.5px; /* Espaciado entre letras */
}

/* Estilo para el mensaje de bienvenida */
.welcome-message p {
    font-size: 18px;
    color: #00272d; /* Color2 */
    line-height: 1.6;
}

/* Efecto hover para la carta */
.welcome-card:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
}

/* Estilo adicional para la vista general */
.content {
    text-align: center;
    margin: 20px;
    margin-left: 190px;
}

.cosas {
    text-align: center;
}

    </style>
  </head>
  <body>

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
    <i class="fas fa-user-edit"></i> Gestor de Usuarios
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

<!-- Vista de Inicio con contenedor estilizado -->
<div class="content">
  <div class="welcome-container">
    <div class="welcome-card">
      <div class="welcome-header">
        <h1>Bienvenido/a al Sistema</h1>
      </div>
      <div class="welcome-message">
        <?php 
        // Mostrar mensaje basado en el rol
        if ($rol == 5) { // Administrador
            echo "<p>Hola Administrador, bienvenido. Aquí podrás gestionar usuarios, tarjetas y revisar reportes para asegurar que todo esté en orden. ¡Gracias por mantener el sistema funcionando de manera eficiente!</p>";
        } elseif ($rol == 6) { // Supervisor
            echo "<p>Hola Supervisor, bienvenido/a. En esta sección podrás monitorear el estado de las tarjetas, revisar alertas y accesos. ¡Gracias por asegurarte de que todo esté bajo control!</p>";
        } elseif ($rol == 7) { // Usuario
            echo "<p>Hola Usuario, bienvenido/a. Aquí puedes consultar el estado de tus tarjetas y asegurarte de que todo está en orden. ¡Gracias por usar nuestro sistema!</p>";
        }
        ?>

      </div>
    </div>
  </div>
</div>

<script>
function cerrarsesion(url){
  if(confirm('¿Seguro Queres Cerrar Sesion?')){
    window.location.href=url;
  }
}
</script>

  </body>
</html>

