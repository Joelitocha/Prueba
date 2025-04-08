<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de control de acceso inteligente para racks de servidores con RFID, sensores y cámaras. Seguridad de siguiente nivel.">
    <meta name="author" content="Federico Arias - Joel Martinez Vilche">
    <meta property="og:image" content="assets/images/header-background.jpg">
    <title>RackON - Rack Security</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link href="https://unpkg.com/swiper@7/swiper-bundle.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
    <style>
    :root {
        --primary-color: #7dc22b;
        --dark-color: #161223;
        --light-color: #f7f9fd;
        --text-color: #53575a;
    }
    
    body {
        font-family: 'Open Sans', sans-serif;
        color: var(--text-color);
        overflow-x: hidden;
        scroll-behavior: smooth;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
        color: var(--dark-color);
        font-weight: 600;
    }
    
    /* Secciones de página completa */
    .fullpage-section {
        width: 100%;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        padding: 80px 0;
        display: flex;
        align-items: center;
    }
    
    /* Header */
    #header {
        background: linear-gradient(rgba(21, 35, 63, 0.7), rgba(21, 35, 63, 0.7)), url('assets/images/rackon-og.jpg') center center no-repeat;
        background-size: cover;
        color: white;
        text-align: center;
    }
    
    #header .h1-large {
        font-size: 3rem;
        line-height: 1.2;
        margin-bottom: 30px;
    }
    
    /* Botones */
    .btn-solid-lg {
        display: inline-block;
        padding: 15px 30px;
        border: 1px solid var(--primary-color);
        border-radius: 4px;
        background-color: var(--primary-color);
        color: white;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-solid-lg:hover {
        background-color: transparent;
        color: var(--primary-color);
    }
    
    /* Tarjetas */
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s;
        height: 100%;
    }
    
    .card:hover {
        transform: translateY(-10px);
    }
    
    .card-icon {
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 20px;
    }
    
    /* Sección dividida */
    .split-section {
        display: flex;
        flex-wrap: wrap;
    }
    
    .split-section .area-1 {
        flex: 1;
        min-height: 400px;
        background: url('assets/images/details-background.jpg') center center no-repeat;
        background-size: cover;
    }
    
    .split-section .area-2 {
        flex: 1;
        padding: 50px;
        display: flex;
        align-items: center;
        background-color: var(--light-color);
    }
    
    /* Testimonios */
    .testimonial-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
    }
    
    /* Contacto */
    #contact {
        background: linear-gradient(rgba(2, 15, 29, 0.8), rgba(2, 15, 29, 0.8)), url('assets/images/contact-background.jpg') center center no-repeat;
        background-size: cover;
        color: white;
    }
    
    /* Footer */
    footer {
        background-color: var(--dark-color);
        color: white;
        padding: 50px 0 20px;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        #header .h1-large {
            font-size: 2.5rem;
        }
        
        .split-section .area-1,
        .split-section .area-2 {
            flex: 100%;
        }
    }
    
    @media (max-width: 768px) {
        #header .h1-large {
            font-size: 2rem;
        }
    }
    </style>
</head>
<body>
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--dark-color);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo.svg" alt="RackON Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#header">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#introduction">¿Qué es RackON?</a></li>
                    <li class="nav-item"><a class="nav-link" href="#funcionamiento">Cómo funciona</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hardware">Hardware</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="login">Acceder</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section id="header" class="fullpage-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="h1-large">Sistema Inteligente de Seguridad para Racks de Servidores</h1>
                    <a class="btn-solid-lg mt-3" href="#introduction">Conocer más</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section id="introduction" class="fullpage-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>¿Qué es RackON?</h2>
                    <p class="lead">
                        <strong>RackON</strong> es un sistema inteligente de control de acceso físico diseñado para racks de servidores. 
                        Combina tecnologías como RFID, sensores de vibración y cámaras de vigilancia para ofrecer una solución de seguridad robusta y en capas.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h4>Identificación RFID</h4>
                            <p>
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
                            <h4>Detección de Vibración</h4>
                            <p>
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
                            <h4>Monitoreo por Cámara</h4>
                            <p>
                                Captura imágenes o video del acceso en tiempo real, permitiendo una supervisión visual directa del entorno del rack.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Details -->
    <section id="funcionamiento" class="fullpage-section p-0">
        <div class="split-section">
            <div class="area-1"></div>
            <div class="area-2">
                <div class="container">
                    <h2>¿Cómo funciona RackON?</h2>
                    <p>
                        RackON está compuesto por tres niveles de seguridad que trabajan en conjunto para proteger el acceso físico a los racks:
                    </p>
                    <ul>
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
    </section>

    <!-- Hardware -->
    <section id="hardware" class="fullpage-section bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-12">
                    <h2>Hardware Utilizado</h2>
                    <p class="lead">Los siguientes dispositivos permiten implementar los tres niveles de seguridad del sistema RackON.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-microchip card-icon"></i>
                            <h5>ESP32</h5>
                            <p>Microcontrolador principal que gestiona la lectura de tarjetas RFID, sensores y comunicación con la base de datos.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-id-card card-icon"></i>
                            <h5>Lector RFID RC522</h5>
                            <p>Dispositivo de lectura de tarjetas para autenticar el acceso físico al rack mediante identificación por radiofrecuencia.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-bolt card-icon"></i>
                            <h5>Sensor de Vibración</h5>
                            <p>Detecta intentos de manipulación física del rack, como golpes o movimientos bruscos no autorizados.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-video card-icon"></i>
                            <h5>Cámara de Vigilancia</h5>
                            <p>Captura imágenes o video del acceso en tiempo real, permitiendo registrar eventos sospechosos visualmente.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-lock card-icon"></i>
                            <h5>Mecanismo de Bloqueo</h5>
                            <p>Sistema electromecánico que permite o deniega el acceso al rack físicamente tras la validación.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="fullpage-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2>Lo que dicen nuestros clientes</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper-container testimonial-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide text-center">
                                <img class="testimonial-image" src="assets/images/testimonial-1.jpg" alt="Cliente 1">
                                <p class="testimonial-text">"RackON ha transformado nuestra seguridad física. Ahora tenemos control total sobre quién accede a nuestros racks y cuándo."</p>
                                <div class="testimonial-author">Carlos Méndez</div>
                                <div class="testimonial-position">CTO - DataCenter Solutions</div>
                            </div>
                            
                            <div class="swiper-slide text-center">
                                <img class="testimonial-image" src="assets/images/testimonial-2.jpg" alt="Cliente 2">
                                <p class="testimonial-text">"La combinación de RFID, sensores y cámara nos da una seguridad en capas que ningún otro producto ofrece."</p>
                                <div class="testimonial-author">Ana Rodríguez</div>
                                <div class="testimonial-position">Directora de IT - SecureNet</div>
                            </div>
                            
                            <div class="swiper-slide text-center">
                                <img class="testimonial-image" src="assets/images/testimonial-3.jpg" alt="Cliente 3">
                                <p class="testimonial-text">"Implementamos RackON en todos nuestros racks críticos. La interfaz web es intuitiva y los reportes detallados."</p>
                                <div class="testimonial-author">Luis Fernández</div>
                                <div class="testimonial-position">Gerente de Infraestructura - CloudTech</div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="fullpage-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-5">
                    <h2>Contáctenos</h2>
                    <p class="lead">Complete el formulario y nos pondremos en contacto con usted</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Nombre" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Mensaje" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn-solid-lg">Enviar Mensaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h6>Sobre RackON</h6>
                    <p>Sistema de seguridad en capas para racks de servidores que combina RFID, sensores y cámaras para protección física de infraestructura crítica.</p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6>Enlaces</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Términos y Condiciones</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#header">Inicio</a></li>
                        <li><a href="#introduction">Características</a></li>
                        <li><a href="#contact">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6>Redes Sociales</h6>
                    <div class="social-icons mb-3">
                        <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                    <p>Contáctenos: <a href="mailto:info@rackon.com">info@rackon.com</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Copyright -->
    <div class="text-center py-3" style="background-color: rgba(0,0,0,0.2);">
        <div class="container">
            <p class="mb-0">Copyright © <script>document.write(new Date().getFullYear())</script> RackON</p>
        </div>
    </div>

    <!-- Back To Top Button -->
    <button id="backToTop" class="btn btn-primary rounded-circle" style="position: fixed; bottom: 20px; right: 20px; display: none;">
        <i class="fas fa-arrow-up"></i>
    </button>
        
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    
    <!-- Scripts personalizados -->
    <script>
    // Inicializar Swiper para testimonios
    new Swiper('.testimonial-slider', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        autoplay: {
            delay: 5000,
        }
    });
    
    // Botón volver arriba
    window.addEventListener('scroll', function() {
        var backToTop = document.getElementById('backToTop');
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'block';
        } else {
            backToTop.style.display = 'none';
        }
    });
    
    document.getElementById('backToTop').addEventListener('click', function() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
    
    // Efecto navbar al hacer scroll
    window.addEventListener('scroll', function() {
        var navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        } else {
            navbar.style.boxShadow = 'none';
        }
    });
    </script>
</body>
</html>