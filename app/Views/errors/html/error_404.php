<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Página no encontrada | RackON.tech</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-dark: #242d43;
            --color-primary: #3a4259;
            --color-secondary: #4f5870;
            --color-medium: #656d86;
            --color-light: #7a829c;
            --color-accent: #00c6ff;
            --text-color: #f0f2f5;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            min-height: 100vh;
            background: 
                linear-gradient(rgba(36, 45, 67, 0.85), rgba(36, 45, 67, 0.9)),
                url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat fixed;
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        
        .main-container {
            width: 75vw;
            max-width: 1200px;
            min-height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .wrap {
            width: 100%;
            padding: 4rem 3rem;
            background: rgba(36, 45, 67, 0.7);
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(122, 130, 156, 0.3);
            backdrop-filter: blur(8px);
            position: relative;
            overflow: hidden;
        }
        
        .wrap::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, var(--color-accent), transparent);
        }
        
        .logo {
            height: 100px;
            opacity: 0.9;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 10px rgba(0, 198, 255, 0.7));
        }
        
        h1 {
            font-family: 'Share Tech Mono', monospace;
            font-weight: 500;
            font-size: 7rem;
            margin: 0.5rem 0;
            color: var(--color-accent);
            text-shadow: 0 0 15px rgba(0, 198, 255, 0.7);
            letter-spacing: -5px;
        }
        
        h2 {
            font-weight: 400;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--text-color);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        p {
            margin: 2rem 0;
            color: var(--color-light);
            font-size: 1.1rem;
            line-height: 1.8;
        }
        
        .error-details {
            background-color: rgba(58, 66, 89, 0.6);
            border-left: 3px solid var(--color-accent);
            padding: 1.2rem;
            margin: 2rem 0;
            text-align: left;
            border-radius: 0 6px 6px 0;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.95rem;
            color: var(--color-light);
            overflow-x: auto;
        }
        
        .actions {
            margin: 3rem 0 2rem;
        }
        
        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: transparent;
            color: var(--color-accent);
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.4s ease;
            border: 2px solid var(--color-accent);
            cursor: pointer;
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        
        .btn:hover {
            background: rgba(0, 198, 255, 0.15);
            box-shadow: 0 0 20px rgba(0, 198, 255, 0.4);
            transform: translateY(-2px);
        }
        
        .footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--color-medium);
            width: 100%;
            border-top: 1px solid var(--color-primary);
            padding-top: 1.5rem;
        }
        
        a {
            color: var(--color-accent);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        a:hover {
            color: white;
            text-shadow: 0 0 8px rgba(0, 198, 255, 0.8);
        }
        
        .glow {
            animation: glow 1.5s ease-in-out infinite alternate;
        }
        
        @keyframes glow {
            from {
                text-shadow: 0 0 5px rgba(0, 198, 255, 0.5);
            }
            to {
                text-shadow: 0 0 15px rgba(0, 198, 255, 0.9), 0 0 20px rgba(0, 198, 255, 0.6);
            }
        }
        
        @media (max-width: 1200px) {
            .main-container {
                width: 85vw;
            }
        }
        
        @media (max-width: 992px) {
            .main-container {
                width: 90vw;
            }
            
            h1 {
                font-size: 5rem;
            }
            
            h2 {
                font-size: 1.6rem;
            }
        }
        
        @media (max-width: 768px) {
            .main-container {
                width: 95vw;
            }
            
            .wrap {
                padding: 3rem 2rem;
            }
            
            .logo {
                height: 80px;
            }
            
            h1 {
                font-size: 4rem;
            }
            
            .btn {
                padding: 0.8rem 2rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="wrap">
            <img src="https://rackon.tech/logo.png" alt="RackON.tech Logo" class="logo" onerror="this.style.display='none'">
            
            <h1 class="glow">404</h1>
            <h2>Recurso no disponible</h2>
            
            <p>
                <?php if (ENVIRONMENT !== 'production') : ?>
                    <div class="error-details">
                        <?= nl2br(esc($message)) ?>
                    </div>
                <?php else : ?>
                    El servidor no puede encontrar el recurso solicitado.<br>
                    Puede que la página haya sido movida o eliminada.
                <?php endif; ?>
            </p>
            
            <div class="actions">
                <a href="/" class="btn">Volver al Dashboard</a>
            </div>
            
            <div class="footer">
                <p>Sistema RackON &copy; <?= date('Y') ?> <a href="https://rackon.tech" target="_blank">RackON.tech</a> | Todos los derechos reservados</p>
            </div>
        </div>
    </div>
</body>
</html>