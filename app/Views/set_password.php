<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Establecer Contraseña - RackON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }
        
        .password-container {
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .logo img {
            max-width: 150px;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        
        .btn-rackon {
            background-color: #3498db;
            border: none;
            width: 100%;
            padding: 12px;
            font-weight: 500;
        }
        
        .btn-rackon:hover {
            background-color: #2980b9;
        }
        
        .password-strength {
            height: 5px;
            background: #eee;
            margin-top: 5px;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            background: transparent;
            transition: all 0.3s;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="password-container">
            <div class="logo">
                <!-- Puedes colocar aquí tu logo -->
                <h2>RackON</h2>
            </div>
            
            <h3 class="form-title">Establecer Contraseña</h3>
            
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= site_url('/complete-registration') ?>" method="POST" id="passwordForm">
                <input type="hidden" name="token" value="<?= $token ?>">
                
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    <div class="password-strength">
                        <div class="password-strength-bar" id="passwordStrengthBar"></div>
                    </div>
                    <div class="form-text">Mínimo 8 caracteres (recomendado: mayúsculas, números y símbolos)</div>
                </div>
                
                <div class="mb-4">
                    <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required minlength="8">
                    <div class="invalid-feedback" id="passwordMatchFeedback">Las contraseñas no coinciden</div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-rackon">Establecer Contraseña</button>
            </form>
            
            <div class="form-footer">
                <p>¿Ya tienes una cuenta? <a href="<?= site_url('/') ?>">Iniciar sesión</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm_password');
            const passwordMatchFeedback = document.getElementById('passwordMatchFeedback');
            const passwordStrengthBar = document.getElementById('passwordStrengthBar');
            const form = document.getElementById('passwordForm');
            
            // Validación de coincidencia de contraseñas
            function validatePasswordMatch() {
                if (passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.classList.add('is-invalid');
                    return false;
                } else {
                    confirmPasswordInput.classList.remove('is-invalid');
                    return true;
                }
            }
            
            // Indicador de fortaleza de contraseña
            function updatePasswordStrength() {
                const password = passwordInput.value;
                let strength = 0;
                
                if (password.length >= 8) strength += 1;
                if (password.match(/[A-Z]/)) strength += 1;
                if (password.match(/[0-9]/)) strength += 1;
                if (password.match(/[^A-Za-z0-9]/)) strength += 1;
                
                const width = strength * 25;
                let color = '#dc3545'; // Rojo
                
                if (strength >= 3) color = '#ffc107'; // Amarillo
                if (strength >= 4) color = '#28a745'; // Verde
                
                passwordStrengthBar.style.width = width + '%';
                passwordStrengthBar.style.backgroundColor = color;
            }
            
            // Event listeners
            passwordInput.addEventListener('input', updatePasswordStrength);
            confirmPasswordInput.addEventListener('input', validatePasswordMatch);
            
            form.addEventListener('submit', function(e) {
                if (!validatePasswordMatch()) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>