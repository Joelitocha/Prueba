<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>RackON - Sistema de Control de Acceso RFID | Argentina</title>
  <meta name="description" content="Sistema profesional de gestión de accesos mediante tarjetas RFID. Inicie sesión para administrar su cuenta.">

  <!-- Estilos y fuentes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                  url('https://www.celmad.com/wp-content/uploads/2023/11/Que-es-un-centro-de-datos-y-por-que-estan-en-auge-2048x1170.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      color: white;
      text-align: center;
    }

    h1 {
      font-size: 3rem;
      margin-bottom: 10px;
    }

    p {
      font-size: 1.2rem;
      max-width: 600px;
      margin-bottom: 30px;
    }

    .btn-show-login {
      background-color: #0c7e7e;
      color: white;
      padding: 14px 28px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-show-login:hover {
      background-color: #0a5f5f;
    }

    /* === Modal login === */
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.8);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    .login-container {
      background-color: #2b2b2b;
      padding: 40px;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 30px rgba(0,0,0,0.7);
      position: relative;
    }

    .login-container h2 {
      color: #3498db;
      margin-bottom: 30px;
    }

    .form-login {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .input-group {
      position: relative;
    }

    .input-group input {
      width: 100%;
      padding: 14px 40px;
      border-radius: 6px;
      background-color: #3a3a3a;
      border: 1px solid #444;
      color: white;
      font-size: 15px;
    }

    .input-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #aaa;
    }

    .btn-login {
      padding: 14px;
      background-color: #3498db;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    .btn-login:hover {
      background-color: #2980b9;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 20px;
      color: #ccc;
      cursor: pointer;
    }

    .close-btn:hover {
      color: white;
    }

    @media (max-width: 500px) {
      h1 {
        font-size: 2rem;
      }

      .login-container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <h1><i class="fas fa-server"></i> RackON</h1>
  <p>Sistema inteligente de gestión de acceso a racks y centros de datos mediante tecnología RFID. Seguridad, eficiencia y control desde un solo lugar.</p>

  <button class="btn-show-login" onclick="mostrarLogin()">Iniciar Sesión</button>

  <!-- MODAL -->
  <div class="modal" id="loginModal">
    <div class="login-container">
      <span class="close-btn" onclick="cerrarLogin()">&times;</span>
      <h2><i class="fas fa-lock"></i> Iniciar Sesión</h2>

      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif; ?>

      <form action="<?= base_url('login') ?>" method="POST" class="form-login">
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="text" name="Email" placeholder="Correo Electrónico" required>
        </div>
        <div class="input-group">
          <i class="fas fa-key"></i>
          <input type="password" name="Contraseña" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Entrar</button>
      </form>
    </div>
  </div>

  <script>
    function mostrarLogin() {
      document.getElementById('loginModal').style.display = 'flex';
    }

    function cerrarLogin() {
      document.getElementById('loginModal').style.display = 'none';
    }

    // Cerrar el modal si se hace clic fuera del contenedor
    window.onclick = function(event) {
      const modal = document.getElementById('loginModal');
      if (event.target === modal) {
        modal.style.display = "none";
      }
    };
  </script>
</body>
</html>
