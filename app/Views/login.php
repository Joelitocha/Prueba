<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>RackON - Presentación</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <style>
    /* === GENERAL === */
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url('https://www.celmad.com/wp-content/uploads/2023/11/Que-es-un-centro-de-datos-y-por-que-estan-en-auge-2048x1170.jpg') no-repeat center center fixed;
      background-size: cover;
      color: white;
      text-align: center;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    h1 {
      font-size: 3em;
      margin-bottom: 20px;
    }

    .btn-show-login {
      padding: 15px 30px;
      background-color: #3498db;
      border: none;
      color: white;
      font-size: 1em;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn-show-login:hover {
      background-color: #2980b9;
    }

    /* === MODAL === */
    .modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal.active {
      display: flex;
    }

    .login-container {
      background-color: #2b2b2b;
      padding: 40px;
      border-radius: 8px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
      text-align: center;
      position: relative;
    }

    .login-container h2 {
      color: #3498db;
      margin-bottom: 30px;
    }

    .close-modal {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 20px;
      cursor: pointer;
      color: #aaa;
    }

    .close-modal:hover {
      color: #fff;
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
      padding: 14px 20px;
      padding-left: 40px;
      border: 1px solid #444;
      border-radius: 6px;
      background-color: #3a3a3a;
      color: #fff;
      font-size: 15px;
    }

    .input-group i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #7f8c8d;
    }

    .btn-login {
      padding: 14px;
      border-radius: 6px;
      background-color: #3498db;
      color: white;
      font-size: 16px;
      font-weight: 500;
      border: none;
      cursor: pointer;
    }

    .btn-login:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
  <h1>Bienvenido a RackON</h1>
  <button class="btn-show-login" onclick="mostrarModal()">Iniciar sesión</button>

  <!-- Modal con formulario -->
  <div class="modal" id="modalLogin" onclick="cerrarModal(event)">
    <div class="login-container" onclick="event.stopPropagation()">
      <span class="close-modal" onclick="ocultarModal()">&times;</span>
      <h2><i class="fas fa-lock"></i> Iniciar Sesión</h2>

      <form action="<?= base_url('login') ?>" method="POST" class="form-login">
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="text" name="Email" placeholder="Correo Electrónico" required />
        </div>

        <div class="input-group">
          <i class="fas fa-key"></i>
          <input type="password" name="Contraseña" placeholder="Contraseña" required />
        </div>

        <button type="submit" class="btn-login">
          <i class="fas fa-sign-in-alt"></i> Entrar
        </button>
      </form>
    </div>
  </div>

  <script>
    function mostrarModal() {
      document.getElementById('modalLogin').classList.add('active');
    }

    function ocultarModal() {
      document.getElementById('modalLogin').classList.remove('active');
    }

    function cerrarModal(e) {
      if (e.target.id === 'modalLogin') {
        ocultarModal();
      }
    }
  </script>
</body>
</html>
