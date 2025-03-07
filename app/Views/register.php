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
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/register.css'); ?>"> <!-- Enlazando el CSS del Sidebar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
/* Fondo */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2); /* Fondo degradado */
    color: #333;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Contenedor del formulario */
.registro {
    background-color: #ffffff; /* Fondo blanco */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Sombra */
    padding: 20px;
    width: 400px;
    max-width: 90%;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #e4e4e4;
}

/* Título del formulario */
.registro h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

/* Campos de entrada */
.registro input[type="text"],
.registro input[type="email"],
.registro input[type="password"],
.registro select {
    width: 100%;
    padding: 10px 15px; /* Relleno: 10px arriba/abajo, 15px izquierda/derecha */
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
    box-sizing: border-box; /* Incluye el padding dentro del ancho total */
    text-align: left; /* Asegura que el texto comience a la izquierda */
}

.registro input:focus,
.registro select:focus {
    border-color: #3498db; /* Cambia el color del borde al enfocar */
    outline: none;
}


/* Botones */
.registro button[type="submit"] {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
}

.registro button[type="submit"]:hover {
    background-color: #2980b9;
}

/* Enlace "Volver" */
.registro .volver {
    display: inline-block;
    margin-top: 10px;
    font-size: 14px;
    color: #3498db;
    text-decoration: none;
    transition: color 0.3s ease;
}

.registro .volver:hover {
    color: #1a5a85;
}

/* Flash Card */
.flash-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    padding: 20px;
    text-align: center;
    max-width: 500px;
    margin: 20px auto;
    animation: fadeIn 0.5s ease-out;
}

.flash-header h1 {
    font-size: 24px;
    color: #27ae60; /* Verde para éxito */
    margin-bottom: 10px;
}

.flash-message p {
    font-size: 16px;
    color: #333;
}

/* Animación de aparición */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
  </head>
  <body>
  <div class="registro">
  <form action="<?php echo site_url('/register2') ?>" method="POST" class="formulario__register">
    <h2>Crear Usuario</h2>
    <input type="text" placeholder="Nombre Completo" name="Nombre" required>
    <input type="email" placeholder="Correo Electrónico" name="Email" required>
    <input type="password" placeholder="Contraseña" name="Contraseña" required>
    <label for="ID_Tarjeta">Seleccionar Tarjeta:</label>
    <select name="ID_Tarjeta" id="ID_Tarjeta" required>
      <option value="">Seleccione una tarjeta</option>
      <?php foreach ($tarjetas as $tarjeta): ?>
        <option value="<?= $tarjeta['ID_Tarjeta']; ?>">
          Tarjeta <?= $tarjeta['ID_Tarjeta']; ?>
        </option>
      <?php endforeach; ?>
    </select>
    <label for="ID_Rol">Seleccionar Rol:</label>
    <select name="ID_Rol" id="ID_Rol" required>
      <option value="5">Administrador</option>
      <option value="6">Supervisor</option>
      <option value="7">Usuario</option>
    </select>
    <div class="formulario__acciones">
      <button type="submit">Registrar Usuario</button>
      <a href="modificar-usuario" class="volver">Volver</a>
    </div>
  </form>
</div>
    <?php
      $success = session()->getFlashdata("success");

      if ($success) {
          echo "
          <div class='flash-card'>
              <div class='flash-header'>
                  <h1>Operación Exitosa</h1>
              </div>
              <div class='flash-message'>
                  <p>$success</p>
              </div>
          </div>";
      }
    ?>
<script>
function cerrarsesion(url){
  if(confirm('¿Seguro Queres Cerrar Sesion?')){
    window.location.href=url;
  }
}
</script>

  </body>
</html>