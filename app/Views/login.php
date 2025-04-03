<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
  </head>
  <body background="../images/bg5.jpg">
  <style>
    
/* Paleta de colores */
:root {
    --color1: #20130a ;
    --color2: #142026 ;
    --color3: #ffffff ;
    --color4: #3b657a ;
    --color5: #e9f0c956 ;
  }
  
  body{
    background-image: url("https://www.celmad.com/wp-content/uploads/2023/11/Que-es-un-centro-de-datos-y-por-que-estan-en-auge-2048x1170.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }
  html {
    height: 100%;
    margin: 0;
    font-family: 'Roboto', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .main-login {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  
  .login-container {
    background: var(--color2);
    padding: 50px;
    border-radius: 30px; /* Forma alargada */
    width: 400px;
    text-align: center;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5); /* Sombra */
  }
  
  .title {
    color: var(--color3);
    font-size: 24px;
    margin-bottom: 30px;
  }
  
  .form-login {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .input-group input {
    width: 93%;
    padding: 15px;
    border-radius: 20px; /* Bordes redondeados */
    border: none;
    background: var(--color4);
    color: white;
    font-size: 18px;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }
  
  .input-group input:focus {
    background-color: var(--color5); /* Cambia el color de fondo al interactuar */
    transform: scale(1.05); /* Efecto de enfoque en los inputs */
  }
  
  .btn-login {
    width: 100%;
    padding: 15px;
    border-radius: 20px;
    border: none;
    background: var(--color3);
    color: var(--color1);
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .btn-login:hover {
    background-color: var(--color4);
    color: white;
  }
  
  .btn-login:active {
    transform: scale(0.95);
  }
  
  input::placeholder {
    color: var(--color3);
  }
  
  .extra-links {
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
  }
  
  .extra-links a {
    color: var(--color3);
    text-decoration: none;
    font-size: 14px;
    transition: color 0.3s ease;
  }
  
  .extra-links a:hover {
    color: var(--color5);
  }
  
  
  </style>
    <main class="main-login">
      <div class="login-container">
        <h2 class="title">Iniciar Sesión</h2>
        <form action="<?= base_url('login') ?>" method="POST" class="form-login">
          <div class="input-group">
            <input type="text" placeholder="Correo Electrónico" name="Email" required>
          </div>
          <div class="input-group">
            <input type="password" placeholder="Contraseña" name="Contraseña" required>
          </div>
          <button type="submit" class="btn-login">Entrar</button>
        </form>
        </div>
      </div>
    </main>
    
  </body>
</html>
