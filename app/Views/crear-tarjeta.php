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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarjeta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        color: #333;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .crear {
        max-width: 600px;
        margin: 50px auto;
        background: #ffffff;
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
    .crear input[type="date"],
    .crear input[type="number"],
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
    .crear input[type="date"]:focus,
    .crear input[type="number"]:focus,
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

    .crear .form-group {
        margin-bottom: 15px;
    }

    .crear .form-note {
        font-size: 12px;
        color: #666;
        margin-top: -10px;
        margin-bottom: 15px;
    }
    </style>
</head>
<body>
<div class="crear">
    <h1>Crear Tarjeta</h1>

    <form action="<?php echo site_url('/crear-tarjeta') ?>" method="post">
        <div class="form-group">
            <label for="Estado">Estado</label>
            <select name="Estado" required>
                <option value="1">Activa</option>
                <option value="0">Inactiva</option>
            </select>
        </div>

        <div class="form-group">
            <label for="UID">UID de la Tarjeta</label>
            <input type="text" name="UID" id="UID" placeholder="Ingrese el UID de la tarjeta (ej: 0x2a6a991a)" required>
            <p class="form-note">Formato: 0x seguido de 8 caracteres hexadecimales</p>
        </div>

        <div class="form-group">
            <label for="Fecha_Expiracion">Fecha de Expiración</label>
            <input type="date" name="Fecha_Expiracion" id="Fecha_Expiracion" value="">
            <p class="form-note">Dejar vacío para tarjeta sin fecha de expiración</p>
        </div>


        <div class="form-group">
            <label for="Horario_Uso">Horario de Uso</label>
            <input type="text" name="Horario_Uso" id="Horario_Uso" value="" placeholder="Ej: 08:00-18:00 o L-V:08:00-18:00,S-D:10:00-15:00">
            <p class="form-note">Dejar vacío para tarjeta sin restricción horaria</p>
        </div>

        <div class="form-group">
            <label for="Intentos_Fallidos">Intentos Fallidos Permitidos</label>
            <input type="number" name="Intentos_Fallidos" id="Intentos_Fallidos" min="1" max="5" value="3">
            <p class="form-note">Número de intentos fallidos antes del bloqueo automático (1-5)</p>
        </div>

        <input type="submit" value="Crear Tarjeta">
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
    if(confirm('¿Seguro quieres cerrar sesión?')){
        window.location.href=url;
    }
}
</script>

</body>
</html>