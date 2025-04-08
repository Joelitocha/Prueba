<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de control de acceso inteligente para racks de servidores con RFID, sensores y cámaras. Seguridad de siguiente nivel.">
    <meta name="author" content="Federico Arias - Joel Martinez Vilche">
    <meta property="og:image" content="<?= base_url('assets/images/header-background.jpg') ?>">
    <title>RackON - Rack Security</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/fontawesome-all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/swiper.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>">
    
    <style>
    /* Estilos generales mejorados */
    :root {
        --primary-color: #7dc22b;
        --dark-color: #161223;
        --light-gray: #f7f9fd;
        --medium-gray: #e9ecef;
        --text-color: #53575a;
    }
    
    body {
        font-family: 'Open Sans', sans-serif;
        color: var(--text-color);
        line-height: 1.6;
        scroll-behavior: smooth;
        padding-top: 80px; /* Para el navbar fijo */
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
        color: var(--dark-color);
        font-weight: 600;
    }
    
    a {
        color: var(--primary-color);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    a:hover {
        color: #5a9a1d;
    }
    
    .bg-gray {
        background-color: var(--light-gray);
    }
    
    .bg-medium-gray {
        background-color: var(--medium-gray);
    }
    
    /* Navbar mejorado */
    .navbar {
        background-color: var(--dark-color);
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }
    
    .navbar-brand img {
        height: 40px;
        transition: all 0.3s ease;
    }
    
    .navbar-brand:hover img {
        opacity: 0.8;
    }
    
    .nav-link {
        position: relative;
        padding: 0.5rem 1rem;
    }
    
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 1rem;
        background-color: var(--primary-color);
        transition: width 0.3s ease;
    }
    
    .nav-link:hover::after,
    .nav-link.active::after {
        width: calc(100% - 2rem);
    }
    
    /* Header con video */
    .header {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        color: white;
        overflow: hidden;
    }
    
    .header-content {
        position: relative;
        z-index: 2;
        width: 100%;
        padding: 2rem 0;
    }
    
    #video-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }
    
    /* Secciones comunes */
    .section {
        padding: 6rem 0;
    }
    
    .section-title {
        margin-bottom: 3rem;
        text-align: center;
    }
    
    /* Cards */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .card-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background-color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
    }
    
    /* Sección de hardware */
    .hardware-card {
        transition: all 0.3s ease;
    }
    
    .hardware-card:hover {
        transform: translateY(-5px);
    }
    
    /* Testimonios */
    .testimonial-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin: 0 auto 1.5rem;
        border: 3px solid var(--primary-color);
    }
    
    /* Formulario de contacto */
    .form-control {
        border-radius: 4px;
        padding: 1rem;
        border: 1px solid #ddd;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(125, 194, 43, 0.25);
    }
    
    /* Footer */
    .footer {
        background-color: var(--dark-color);
        color: white;
        padding: 3rem 0;
    }
    
    .footer a {
        color: white;
    }
    
    .footer a:hover {
        color: var(--primary-color);
    }
    
    /* Botón volver arriba */
    #myBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 99;
        width: 50px;
        height: 50px;
        border: none;
        border-radius: 50%;
        background-color: var(--primary-color);
        color: white;
        font-size: 1.25rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    #myBtn:hover {
        background-color: var(--dark-color);
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .section {
            padding: 4rem 0;
        }
        
        .header .h1-large {
            font-size: 2.5rem;
        }
    }
    
    @media (max-width: 768px) {
        body {
            padding-top: 70px;
        }
        
        .header .h1-large {
            font-size: 2rem;
        }
        
        #video-background {
            display: none;
        }
        
        .header {
            background: linear-gradient(rgba(22, 18, 35, 0.8), url('<?= base_url('assets/images/rackon-og.jpg') ?>') center/cover no-repeat;
        }
        
        .section {
            padding: 3rem 0;
        }
    }
    
    @media (max-width: 576px) {
        .header .h1-large {
            font-size: 1.8rem;
        }
        
        .section {
            padding: 2rem 0;
        }
    }
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#header">
                <img src="<?= base_url('assets/images/logo.svg') ?>" alt="RackON Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#header">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#introduction">¿Qué es RackON?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#funcionamiento">Cómo funciona</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hardware-utilizado">Hardware</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Testimonios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Acceder</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container text-center">
                <h1 class="h1-large mb-4">Sistema Inteligente de Seguridad para Racks</h1>
                <p class="lead mb-5">Protección avanzada con tecnología RFID, sensores y monitoreo visual en tiempo real</p>
                <a href="#introduction" class="btn btn-primary btn-lg">Conocer más</a>
            </div>
        </div>
        
        <video autoplay loop muted id="video-background" poster="<?= base_url('assets/images/rackon-og.jpg') ?>" playsinline>
            <source src="<?= base_url('assets/videos/rackon-bg.mp4') ?>" type="video/mp4">
        </video>
    </header>

    <!-- Introduction -->
    <section id="introduction" class="section bg-gray">
        <div class="container">
            <div class="section-title">
                <h2>¿Qué es RackON?</h2>
                <p class="lead"><strong>RackON</strong> es un sistema inteligente de control de acceso físico diseñado para racks de servidores.</p>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h4>Identificación RFID</h4>
                            <p>Control de acceso mediante tarjetas RFID con registro detallado de accesos.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h4>Detección de Vibración</h4>
                            <p>Sensores ultrasensibles que detectan manipulación no autorizada.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center p-4">
                            <div class="card-icon">
                                <i class="fas fa-video"></i>
                            </div>
                            <h4>Monitoreo Visual</h4>
                            <p>Cámara HD que registra automáticamente cada acceso al rack.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Funcionamiento -->
    <section id="funcionamiento" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="<?= base_url('assets/images/how-it-works.jpg') ?>" alt="Cómo funciona RackON" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4">¿Cómo funciona RackON?</h2>
                    <p>Tres niveles de seguridad trabajando en conjunto:</p>
                    <ul class="list-unstyled">
                        <li class="mb-3"><strong>1. Verificación RFID:</strong> Autenticación mediante tarjetas RFID.</li>
                        <li class="mb-3"><strong>2. Detección de impacto:</strong> Sensores de vibración para detectar manipulación.</li>
                        <li class="mb-3"><strong>3. Captura visual:</strong> Registro fotográfico de cada acceso.</li>
                    </ul>
                    <p class="mt-4">Todos los eventos quedan registrados con marca de tiempo y pueden ser monitoreados desde la plataforma web.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Hardware -->
    <section id="hardware-utilizado" class="section bg-gray">
        <div class="container">
            <div class="section-title">
                <h2>Hardware Utilizado</h2>
                <p>Componentes de alta calidad para máxima fiabilidad</p>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card hardware-card">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-microchip fa-3x mb-3 text-primary"></i>
                            <h4>ESP32</h4>
                            <p>Microcontrolador principal con WiFi y Bluetooth integrado.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card hardware-card">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-id-card fa-3x mb-3 text-primary"></i>
                            <h4>Lector RFID</h4>
                            <p>Módulo RC522 para lectura de tarjetas RFID.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card hardware-card">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-vibration fa-3x mb-3 text-primary"></i>
                            <h4>Sensor de Vibración</h4>
                            <p>Detecta movimientos y golpes con sensibilidad ajustable.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section id="testimonios" class="section">
        <div class="container">
            <div class="section-title">
                <h2>Lo que dicen nuestros clientes</h2>
            </div>
            
            <div class="swiper-container testimonial-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide text-center">
                        <img src="<?= base_url('assets/images/testimonial-1.jpg') ?>" class="testimonial-image" alt="Cliente 1">
                        <p class="lead mb-4">"RackON ha transformado nuestra seguridad física. Control total sobre accesos a los racks."</p>
                        <h5>Carlos Méndez</h5>
                        <p class="text-muted">CTO - DataCenter Solutions</p>
                    </div>
                    
                    <div class="swiper-slide text-center">
                        <img src="<?= base_url('assets/images/testimonial-2.jpg') ?>" class="testimonial-image" alt="Cliente 2">
                        <p class="lead mb-4">"La combinación de RFID, sensores y cámara nos da una seguridad en capas única."</p>
                        <h5>Ana Rodríguez</h5>
                        <p class="text-muted">Directora de IT - SecureNet</p>
                    </div>
                </div>
                
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contact" class="section bg-gray">
        <div class="container">
            <div class="section-title">
                <h2>Contacto</h2>
                <p>¿Interesado en RackON? Contáctanos para más información</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form class="p-4 bg-white rounded shadow-sm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-4">Sobre RackON</h5>
                    <p>Sistema de seguridad en capas para racks de servidores con tecnología RFID, sensores y cámaras.</p>
                </div>
                
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="text-white mb-4">Enlaces</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#header">Inicio</a></li>
                        <li class="mb-2"><a href="#introduction">Qué es RackON</a></li>
                        <li class="mb-2"><a href="#funcionamiento">Cómo funciona</a></li>
                        <li class="mb-2"><a href="#hardware-utilizado">Hardware</a></li>
                        <li class="mb-2"><a href="#contact">Contacto</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="text-white mb-4">Contacto</h5>
                    <p><i class="fas fa-envelope me-2"></i> info@rackon.com</p>
                    <p><i class="fas fa-phone me-2"></i> +1 (123) 456-7890</p>
                    
                    <div class="mt-4">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 bg-light">
            
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <p class="mb-0">&copy; 2023 RackON. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-3">Términos y Condiciones</a>
                    <a href="#" class="text-white">Política de Privacidad</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Botón volver arriba -->
    <button id="myBtn" title="Volver arriba">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/swiper.min.js') ?>"></script>
    
    <script>
    // Inicializar slider de testimonios
    var testimonialSlider = new Swiper('.testimonial-slider', {
        loop: true,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    
    // Mostrar/ocultar botón volver arriba
    window.onscroll = function() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            document.getElementById("myBtn").style.display = "block";
        } else {
            document.getElementById("myBtn").style.display = "none";
        }
    };
    
    // Volver arriba
    document.getElementById('myBtn').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Cambiar navbar al hacer scroll
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.getElementById('navbar').style.boxShadow = '0 4px 15px rgba(0,0,0,0.2)';
        } else {
            document.getElementById('navbar').style.boxShadow = '0 2px 15px rgba(0,0,0,0.1)';
        }
    });
    
    // Cerrar navbar al hacer clic en un enlace (mobile)
    document.querySelectorAll('.nav-link').forEach(function(navLink) {
        navLink.addEventListener('click', function() {
            var navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                var bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    });
    </script>
</body>
</html>