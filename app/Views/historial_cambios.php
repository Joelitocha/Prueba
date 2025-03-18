<?php

$session = session();
$rol = $session->get("ID_Rol");

?>
<?php
// Verificar si la sesión está iniciada
if (!isset($session)) {
    $session = session();
}

// Verificar si el usuario tiene permiso para entrar a la vista (SOLO ADMIN y SUPERVISOR)
if ($session->get("ID_Rol") != 5 && $session->get("ID_Rol") != 6) {
    echo "No tienes permiso para entrar en esta vista";
    exit;
}

// Obtener la lista de archivos en el directorio de cambios
$directorio = 'cambios/';
$archivos = array_diff(scandir($directorio), array('.', '..'));
?>

<!doctype html>
<html lang="en">
<head>
    <title>Historial de Cambios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #000;
            color: #0f0;
            font-family: monospace;
            padding: 20px;
        }
        .terminal {
            background-color: #111;
            color: #0f0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .historial {
            margin: 20px auto;
            padding: 10px;
            border: 2px solid #0c7e7e;
            border-radius: 5px;
            width: 80%;
            background-color: #222;
        }
        .boton-ver {
            background-color: #0c7e7e;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .boton-ver:hover {
            background-color: #134647;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            color: #0f0;
        }
    </style>
</head>
<body>

<div class="historial">
    <h2>Historial de Cambios</h2>
    <table>
        <tr>
            <th>Archivo</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($archivos as $archivo): ?>
            <tr>
                <td><?php echo $archivo; ?></td>
                <td>
                    <button class="boton-ver" onclick="verContenido('<?php echo $directorio . $archivo; ?>')">Ver</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div id="modal" class="modal">
    <div class="modal-content">
        <span onclick="cerrarModal()" style="cursor: pointer;">&times;</span>
        <pre id="contenido"></pre>
    </div>
</div>

<script>
function verContenido(ruta) {
    $.get(ruta, function(data) {
        $("#contenido").text(data);
        $("#modal").css("display", "flex");
    });
}
function cerrarModal() {
    $("#modal").hide();
}
</script>

</body>
</html>