<!-- asignar-tarjeta.php -->
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
    <title>Asignar Tarjeta</title>
  </head>
  <body>
    <h1>Asignar Tarjeta a Usuario</h1>
    <form action="/asignar-tarjeta-usuario" method="POST">
      <label for="id_usuario">ID del Usuario:</label>
      <input type="text" id="id_usuario" name="id_usuario">
      <br><br>
      <label for="id_tarjeta">ID de la Tarjeta:</label>
      <input type="text" id="id_tarjeta" name="id_tarjeta">
      <br><br>
      <input type="submit" value="Asignar Tarjeta">
    </form>
  </body>
</html>
