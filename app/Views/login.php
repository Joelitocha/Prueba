<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <title>Login</title>
  </head>
  <body>

    <main class="main-login">
      <div class="login-container">
        <h2 class="title">Iniciar Sesión</h2>
        <form action="<?= base_url('login') ?>" method="POST" class="form-login">
          <div class="input-group">
            <input type="text" placeholder="Correo Electrónico" name="Email" required>
          </div>
          <div class="input-group">
            <input type="password" placeholder="Contraseña" name="Contraseña" required>+
          </div>
          <button type="submit" class="btn-login">Entrar</button>
        </form>
        </div>
      </div>
    </main>
    
  </body>
</html>
