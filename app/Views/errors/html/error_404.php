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
            --bg-gradient: linear-gradient(135deg, var(--color-dark) 0%, var(--color-primary) 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            min-height: 100vh;
            background: var(--bg-gradient);
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            line-height: 1.6;
        }
        
        .logo {
            height: 80px;
            opacity: 0.8;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 0 5px rgba(0, 198, 255, 0.5));
        }
        
        .wrap {
            max-width: 650px;
            width: 100%;
            margin: 2rem auto;
            padding: 3rem 2.5rem;
            background: rgba(36, 45, 67, 0.8);
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            border: 1px solid var(--color-medium);
            backdrop-filter: blur(5px);
        }
        
        .wrap::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(to bottom, var(--color-accent), transparent);
        }
        
        h1 {
            font-family: 'Share Tech Mono', monospace;
            font-weight: 500;
            font-size: 6rem;
            margin: 0.5rem 0;
            color: var(--color-accent);
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
            letter-spacing: -5px;
        }
        
        h2 {
            font-weight: 400;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }
        
        p {
            margin: 1.5rem 0;
            color: var(--color-light);
            font-size: 1.05rem;
        }
        
        .error-details {
            background-color: rgba(58, 66, 89, 0.5);
            border-left: 3px solid var(--color-accent);
            padding: 1rem;
            margin: 1.5rem 0;
            text-align: left;
            border-radius: 0 4px 4px 0;
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.9rem;
            color: var(--color-light);
            overflow-x: auto;
        }
        
        .actions {
            margin: 2.5rem 0 1.5rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: transparent;
            color: var(--color-accent);
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid var(--color-accent);
            cursor: pointer;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 198, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        .btn:hover {
            background: rgba(0, 198, 255, 0.1);
            box-shadow: 0 0 10px rgba(0, 198, 255, 0.3);
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--color-medium);
            width: 100%;
            border-top: 1px solid var(--color-primary);
            padding-top: 1rem;
        }
        
        a {
            color: var(--color-accent);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        a:hover {
            color: white;
            text-shadow: 0 0 5px rgba(0, 198, 255, 0.7);
        }
        
        .glow {
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes glow {
            from {
                text-shadow: 0 0 5px rgba(0, 198, 255, 0.5);
            }
            to {
                text-shadow: 0 0 10px rgba(0, 198, 255, 0.8), 0 0 15px rgba(0, 198, 255, 0.5);
            }
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 4rem;
                letter-spacing: -3px;
            }
            
            h2 {
                font-size: 1.4rem;
            }
            
            .wrap {
                padding: 2rem 1.5rem;
            }
            
            .logo {
                height: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <img src="https://rackon.tech/logo.png" alt="RackON.tech Logo" class="logo" onerror="this.style.display='none'">
        
        <h1 class="glow">404</h1>
        <h2>RECURSO NO ENCONTRADO</h2>
        
        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <div class="error-details">
                    <?= nl2br(esc($message)) ?>
                </div>
            <?php else : ?>
                El recurso solicitado no existe o ha sido movido.<br>
                Por favor verifica la URL o navega desde nuestra página principal.
            <?php endif; ?>
        </p>
        
        <div class="actions">
            <a href="/" class="btn">Ir al Inicio</a>
        </div>
        
        <div class="footer">
            <p>Sistema Operativo RackON &copy; <?= date('Y') ?> <a href="https://rackon.tech" target="_blank">RackON.tech</a></p>
        </div>
    </div>
</body>
</html>