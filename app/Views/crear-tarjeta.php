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
    <title>Crear Tarjeta</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/crear.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
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

    .crear {
        max-width: 600px;
        margin: 50px auto;
        background: #ffffff; /* Fondo blanco para el formulario */
        border-radius: 8px;
        padding: 20px 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .crear h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .crear label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .crear input[type="text"],
    .crear select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .crear input[type="text"]:focus,
    .crear select:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
    }

    .crear input[type="submit"] {
        width: 100%;
        padding: 10px;
        background: #3498db;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .crear input[type="submit"]:hover {
        background: #2980b9;
    }

    .crear a {
        display: inline-block;
        margin-top: 10px;
        color: #3498db;
        text-decoration: none;
        font-size: 14px;
    }

    .crear a:hover {
        text-decoration: underline;
    }

    .crear .success-message,
    .crear .error-message {
        margin-top: 15px;
        padding: 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .crear .success-message {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .crear .error-message {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    </style>
</head>
<body>
<div class="crear">
        <h1>Crear Tarjeta</h1>

        <form action="<?php echo site_url('/crear-tarjeta') ?>" method="post">
            <label for="Estado">Estado</label>
            <select name="Estado" required>
                <option value="1">Activa</option>
                <option value="0">Inactiva</option>
            </select>

            <label for="UID">UID de la Tarjeta</label>
            <input type="text" name="UID" id="UID" placeholder="Ingrese el UID de la tarjeta" required>

            <input type="submit" value="Crear">
            <a href="modificar-tarjeta">Volver</a>
        </form>

        <!-- Mensajes de éxito o error -->
        <?php if (session()->has('success')): ?>
            <div class="success-message">
                <?= session('success') ?>
            </div>
        <?php elseif (session()->has('error')): ?>
            <div class="error-message">
                <?= session('error') ?>
            </div>
        <?php endif; ?>
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
