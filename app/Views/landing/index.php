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
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>">
    
    <style>
    /* Estilos responsive adicionales */
    @media (max-width: 992px) {
        .navbar-collapse {
            background-color: #161223;
            padding: 20px;
            margin-top: 15px;
            border-radius: 4px;
        }
        
        .header .h1-large {
            font-size: 2.5rem;
            line-height: 3rem;
        }
        
        .header-content {
            padding-top: 8rem !important;
            padding-bottom: 6rem !important;
        }
        
        .cards-1 .card {
            margin-bottom: 2rem;
        }
        
        .split .area-1 {
            height: 300px;
        }
        
        .split .area-2 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    }
    
    @media (max-width: 768px) {
        .header .h1-large {
            font-size: 2rem;
            line-height: 2.5rem;
        }
        
        .header-content {
            padding-top: 6rem !important;
            padding-bottom: 4rem !important;
        }
        
        .hardware-card {
            margin-bottom: 1.5rem;
        }
        
        .testimonial-text {
            font-size: 1rem !important;
        }
    }
    
    @media (max-width: 576px) {
        .header .h1-large {
            font-size: 1.8rem;
            line-height: 2.2rem;
        }
        
        .btn-solid-lg {
            padding: 1.25rem 2rem !important;
            font-size: 0.875rem !important;
        }
        
        #video-background {
            display: none;
        }
        
        .header {
            background: linear-gradient(rgba(21, 35, 63, 0.7), rgba(21, 35, 63, 0.7)), url('<?= base_url('assets/images/rackon-og.jpg') ?>') center center no-repeat;
            background-size: cover;
        }
    }
    
    /* Estilos para el hardware section */
    .hardware-section {
        padding: 3rem 0;
    }
    
    .hardware-card {
        height: 100%;
        transition: transform 0.3s ease;
    }
    
    .hardware-card:hover {
        transform: translateY(-5px);
    }
    
    .card-icon {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: #7dc22b;
    }
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand logo-image" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/logo.svg') ?>" alt="RackON Logo" style="width: 120px; height: auto;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
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
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="h1-large">Sistema Inteligente de Seguridad para Racks de Servidores</h1>
                        <a class="btn-solid-lg mt-3" href="#introduction">Conocer más</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Video Background -->
        <video autoplay loop muted id="video-background" poster="<?= base_url('assets/images/rackon-og.jpg') ?>" playsinline>
            <source src="<?= base_url('assets/images/rackon-og.jpg') ?>" type="video/mp4">
        </video>
    </header>

    <!-- Introduction -->
    <div id="introduction" class="cards-1 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="h2-heading">¿Qué es RackON?</h2>
                    <p class="p-heading">
                        <strong>RackON</strong> es un sistema inteligente de control de acceso físico diseñado para racks de servidores. 
                        Combina tecnologías como RFID, sensores de vibración y cámaras de vigilancia para ofrecer una solución de seguridad robusta y en capas.
                    </p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h4 class="card-title">Identificación RFID</h4>
                            <p class="card-text">
                                Permite validar el acceso mediante tarjetas RFID, registrando quién accede al rack y cuándo lo hace.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h4 class="card-title">Detección de Vibración</h4>
                            <p class="card-text">
                                Añade un nivel extra de seguridad detectando intentos de manipulación física o golpes no autorizados.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-video"></i>
                            </div>
                            <h4 class="card-title">Monitoreo por Cámara</h4>
                            <p class="card-text">
                                Captura imágenes o video del acceso en tiempo real, permitiendo una supervisión visual directa del entorno del rack.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details -->
    <div id="funcionamiento" class="split">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 p-0 area-1" style="background: url('<?= base_url('assets/images/details-background.jpg') ?>') center center no-repeat; background-size: cover; min-height: 400px;">
                </div>
                <div class="col-lg-6 p-4 p-lg-5 area-2 bg-gray d-flex align-items-center">
                    <div class="text-container">
                        <h2 class="mb-4">¿Cómo funciona RackON?</h2>
                        <p>
                            RackON está compuesto por tres niveles de seguridad que trabajan en conjunto para proteger el acceso físico a los racks:
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-3"><strong>1. Verificación RFID:</strong> El usuario escanea su tarjeta RFID. El sistema consulta la base de datos para validar el acceso.</li>
                            <li class="mb-3"><strong>2. Detección de impacto:</strong> Un sensor de vibración detecta cualquier intento de manipulación física no autorizada.</li>
                            <li class="mb-3"><strong>3. Captura visual:</strong> Se activa una cámara que registra el evento y almacena evidencia visual del acceso.</li>
                        </ul>
                        <p class="mt-4">
                            Todos los eventos quedan registrados en la base de datos y pueden ser monitoreados desde la plataforma web.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hardware Utilizado -->
    <section id="hardware-utilizado" class="py-5 hardware-section bg-gray">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col-lg-12">
                    <h2>Hardware Utilizado</h2>
                    <p class="lead">Los siguientes dispositivos permiten implementar los tres niveles de seguridad del sistema RackON.</p>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4 mb-4">
                    <div class="card h-100 hardware-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-microchip card-icon"></i>
                            <h5 class="card-title">ESP32</h5>
                            <p class="card-text">Microcontrolador principal que gestiona la lectura de tarjetas RFID, sensores y comunicación con la base de datos.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 hardware-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card card-icon"></i>
                            <h5 class="card-title">Lector RFID RC522</h5>
                            <p class="card-text">Dispositivo de lectura de tarjetas para autenticar el acceso físico al rack mediante identificación por radiofrecuencia.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 hardware-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-bolt card-icon"></i>
                            <h5 class="card-title">Sensor de Vibración</h5>
                            <p class="card-text">Detecta intentos de manipulación física del rack, como golpes o movimientos bruscos no autorizados.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100 hardware-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-video card-icon"></i>
                            <h5 class="card-title">Cámara de Vigilancia</h5>
                            <p class="card-text">Captura imágenes o video del acceso en tiempo real, permitiendo registrar eventos sospechosos visualmente.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100 hardware-card shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-lock card-icon"></i>
                            <h5 class="card-title">Mecanismo de Bloqueo</h5>
                            <p class="card-text">Sistema electromecánico que permite o deniega el acceso al rack físicamente tras la validación.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <div class="slider-1 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="mb-5">Lo que dicen nuestros clientes</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-container">
                        <div class="swiper-container card-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="<?= base_url('assets/images/testimonial-1.jpg') ?>" alt="alternative">
                                    <p class="testimonial-text">"RackON ha transformado nuestra seguridad física. Ahora tenemos control total sobre quién accede a nuestros racks y cuándo."</p>
                                    <div class="testimonial-author">Carlos Méndez</div>
                                    <div class="testimonial-position">CTO - DataCenter Solutions</div>
                                </div>
                                
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="<?= base_url('assets/images/testimonial-2.jpg') ?>" alt="alternative">
                                    <p class="testimonial-text">"La combinación de RFID, sensores y cámara nos da una seguridad en capas que ningún otro producto ofrece."</p>
                                    <div class="testimonial-author">Ana Rodríguez</div>
                                    <div class="testimonial-position">Directora de IT - SecureNet</div>
                                </div>
                                
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="<?= base_url('assets/images/testimonial-3.jpg') ?>" alt="alternative">
                                    <p class="testimonial-text">"Implementamos RackON en todos nuestros racks críticos. La interfaz web es intuitiva y los reportes detallados."</p>
                                    <div class="testimonial-author">Luis Fernández</div>
                                    <div class="testimonial-position">Gerente de Infraestructura - CloudTech</div>
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="counter py-5 bg-gray">
        <div class="container">
            <div class="row text-center">
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <div class="counter-cell">
                        <div data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="3" class="purecounter">0</div>
                        <div class="counter-info">Clientes satisfechos</div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-4 mb-md-0">
                    <div class="counter-cell">
                        <div data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1.5" class="purecounter">0</div>
                        <div class="counter-info">Países</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-cell">
                        <div data-purecounter-start="0" data-purecounter-end="99" data-purecounter-duration="3" class="purecounter">0</div>
                        <div class="counter-info">% Disponibilidad</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="counter-cell">
                        <div data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="3" class="purecounter">0</div>
                        <div class="counter-info">Racks protegidos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <div id="contact" class="form-1 py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="h2-heading text-white">Contáctenos</h2>
                    <p class="p-heading text-white">Complete el formulario y nos pondremos en contacto con usted</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control-input" placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control-input" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <textarea class="form-control-textarea" placeholder="Mensaje" required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn-solid-lg">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-col first">
                        <h6>Sobre RackON</h6>
                        <p class="p-small">Sistema de seguridad en capas para racks de servidores que combina RFID, sensores y cámaras para protección física de infraestructura crítica.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="footer-col second">
                        <h6>Enlaces</h6>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li><a href="<?= base_url('terms') ?>">Términos y Condiciones</a></li>
                            <li><a href="<?= base_url('privacy') ?>">Política de Privacidad</a></li>
                            <li><a href="#header">Inicio</a></li>
                            <li><a href="#introduction">Características</a></li>
                            <li><a href="#contact">Contacto</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-col third">
                        <h6>Redes Sociales</h6>
                        <div class="social-icons mb-4">
                            <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        <p class="p-small">Contáctenos: <a href="mailto:info@rackon.com"><strong>info@rackon.com</strong></a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright -->
    <div class="copyright py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="p-small">Copyright © <script>document.write(new Date().getFullYear())</script> RackON</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn">
        <i class="fas fa-arrow-up"></i>
    </button>
        
    <!-- Scripts -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/swiper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/purecounter.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
    
    <script>
    // Inicializar PureCounter
    new PureCounter();
    
    // Inicializar Swiper para testimonios
    var cardSlider = new Swiper('.card-slider', {
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        }
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            document.getElementById('navbar').classList.add('top-nav-collapse');
        } else {
            document.getElementById('navbar').classList.remove('top-nav-collapse');
        }
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    </script>
</body>
</html>