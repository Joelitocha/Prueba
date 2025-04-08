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
    /* ===== ESTILOS GENERALES ===== */
    :root {
        --primary-color: #7dc22b;
        --dark-color: #161223;
        --light-color: #f7f9fd;
        --text-color: #53575a;
    }

    /* ===== SECCIÓN FUNCIONAMIENTO ===== */
    #funcionamiento {
        padding: 23px 0;
        background-color: white;
    }

    /* Contenedor Principal */
    #funcionamiento .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Columnas */
    #funcionamiento .row {
        align-items: stretch;
        margin: 0;
    }

    /* Columna de Imagen */
    #funcionamiento .image-column {
        position: relative;
        min-height: 400px;
    }

    #funcionamiento .image-column img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
    }

    #funcionamiento .image-column:hover img {
        transform: scale(1.02);
    }

    /* Overlay de Texto en Imagen */
    #funcionamiento .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #funcionamiento .image-overlay h2 {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
    }

    /* Columna de Contenido */
    #funcionamiento .content-column {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Títulos */
    #funcionamiento .content-column h2 {
        color: var(--primary-color);
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
    }

    /* Tarjetas de Niveles */
    #funcionamiento .level-card {
        margin-bottom: 1.25rem;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    #funcionamiento .level-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    #funcionamiento .level-card .card-body {
        padding: 1.25rem;
    }

    #funcionamiento .level-card .badge {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: 600;
        background-color: var(--primary-color);
        margin-right: 1rem;
    }

    #funcionamiento .level-card h4 {
        color: var(--primary-color);
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    #funcionamiento .level-card p {
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 0;
    }

    /* Área de Resumen */
    #funcionamiento .summary-box {
        background-color: var(--light-color);
        border-radius: 8px;
        padding: 1.25rem;
        margin-top: 1rem;
    }

    #funcionamiento .summary-box i {
        color: var(--primary-color);
        margin-right: 0.5rem;
    }

    #funcionamiento .summary-box strong {
        font-weight: 600;
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 1199.98px) {
        #funcionamiento .image-overlay h2 {
            font-size: 2rem;
        }
        
        #funcionamiento .content-column {
            padding: 1.5rem;
        }
    }

    @media (max-width: 991.98px) {
        #funcionamiento .image-column {
            min-height: 300px;
            order: 2;
        }
        
        #funcionamiento .content-column {
            order: 1;
            padding-bottom: 0;
        }
        
        #funcionamiento .image-overlay h2 {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 767.98px) {
        #funcionamiento {
            padding: 15px 0;
        }
        
        #funcionamiento .content-column h2 {
            font-size: 1.5rem;
        }
        
        #funcionamiento .level-card h4 {
            font-size: 1.1rem;
        }
        
        #funcionamiento .level-card p {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 575.98px) {
        #funcionamiento .content-column {
            padding: 1rem;
        }
        
        #funcionamiento .image-overlay h2 {
            font-size: 1.5rem;
        }
        
        #funcionamiento .level-card .card-body {
            padding: 1rem;
        }
        
        #funcionamiento .level-card .badge {
            width: 28px;
            height: 28px;
            font-size: 0.9rem;
            margin-right: 0.75rem;
        }
    }
</style>
</head>
<body>
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: var(--dark-color);">
        <div class="container">
            <a class="navbar-brand" href="">
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
                    <li class="nav-item"><a class="nav-link" href="#planes">Planes de Compra</a></li>
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

<!--sección de funcionamiento-->
<section id="funcionamiento" class="container-fluid bg-white py-4"> <!-- 23px aprox de padding -->
    <div class="row g-0 align-items-center"> <!-- Eliminado min-vh-100 -->
        <!-- Columna de Imagen Compacta -->
        <div class="col-lg-6 order-lg-1 order-2">
            <div class="ratio ratio-16x9"> <!-- Proporción controlada -->
                <img src="<?= base_url('assets/images/details-background.jpg') ?>" 
                     alt="Tecnología RackON"
                     class="object-fit-cover">
                <div class="d-flex align-items-center justify-content-center position-absolute top-0 start-0 w-100 h-100" 
                     style="background: rgba(0,0,0,0.3);">
                    <h3 class="text-white m-0">Tecnología en Capas</h3> <!-- Título más pequeño -->
                </div>
            </div>
        </div>
        
        <!-- Columna de Texto Compacta -->
        <div class="col-lg-6 order-lg-2 order-1 py-3 py-lg-4 px-3 px-lg-4"> <!-- Padding reducido -->
            <div>
                <h2 class="h4 text-primary mb-3">¿Cómo funciona RackON?</h2> <!-- Título más compacto -->
                <p class="small mb-3"> <!-- Texto más pequeño -->
                    Sistema de seguridad en capas que combina identificación, sensores y vigilancia electrónica:
                </p>
                
                <!-- Lista compacta con iconos -->
                <div class="vstack gap-3 mb-4"> <!-- Espaciado vertical controlado -->
                    <div class="d-flex">
                        <span class="badge bg-primary rounded-circle flex-shrink-0 me-3" 
                              style="width:28px;height:28px;line-height:28px;">1</span>
                        <div>
                            <h5 class="h6 text-primary mb-1">Verificación RFID</h5>
                            <p class="small mb-0">Validación de tarjetas únicas con registro de acceso y activación del siguiente nivel de seguridad.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <span class="badge bg-primary rounded-circle flex-shrink-0 me-3" 
                              style="width:28px;height:28px;line-height:28px;">2</span>
                        <div>
                            <h5 class="h6 text-primary mb-1">Detección de Impacto</h5>
                            <p class="small mb-0">Monitoreo en tiempo real de vibraciones y movimientos sospechosos con generación de alertas.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <span class="badge bg-primary rounded-circle flex-shrink-0 me-3" 
                              style="width:28px;height:28px;line-height:28px;">3</span>
                        <div>
                            <h5 class="h6 text-primary mb-1">Captura Visual</h5>
                            <p class="small mb-0">Registro automático de imágenes/video como evidencia del acceso.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Resumen ultracompacto -->
                <div class="bg-light p-3 small rounded">
                    <i class="fas fa-database text-primary me-2"></i>
                    <strong>Registro completo:</strong> Todos los eventos se almacenan en base de datos segura para monitoreo y análisis desde la plataforma web.
                </div>
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

<!-- Planes de Compra -->
<section id="planes" class="fullpage-section bg-light py-5">
    <div class="container">
        <div class="row mb-5 text-center">
            <div class="col-lg-12">
                <h2 class="mb-3">Planes de Compra de RackON</h2>
                <p class="lead">Elige el plan que mejor se adapte a las necesidades de tu empresa. Todos los planes incluyen acceso a la plataforma web.</p>
            </div>
        </div>
        <div class="row text-center">

            <!-- Plan Básico -->
            <div class="col-md-6 col-lg-3 offset-lg-0 offset-md-3 mb-4">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-body">
                        <h4 class="card-title">🥉 Secure Access</h4>
                        <p class="card-text"><strong>Ideal para pequeñas empresas</strong></p>
                        <ul class="list-unstyled text-start small">
                            <li>✔ Acceso a 1 rack con RFID</li>
                            <li>✔ 1 capa de seguridad</li>
                            <li>✔ Registro en tiempo real</li>
                            <li>✔ Consulta web de accesos</li>
                            <li>✔ Soporte básico</li>
                            <li>➕ Monitoreo opcional</li>
                        </ul>
                        <hr>
                        <p><strong>Mensual:</strong> $25 USD</p>
                        <p><strong>Anual (10% off):</strong> $270 USD</p>
                        <p><strong>Dispositivo:</strong> $150 USD</p>
                    </div>
                </div>
            </div>

            <!-- Plan Intermedio -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-primary">
                    <div class="card-body">
                        <h4 class="card-title">🥈 Secure Plus</h4>
                        <p class="card-text"><strong>Para empresas medianas</strong></p>
                        <ul class="list-unstyled text-start small">
                            <li>✔ Hasta 5 racks</li>
                            <li>✔ 2 capas: RFID + Cámara</li>
                            <li>✔ Alertas por email</li>
                            <li>✔ Gestión web integrada</li>
                            <li>✔ Soporte prioritario</li>
                            <li>➕ Notificaciones móviles</li>
                        </ul>
                        <hr>
                        <p><strong>Mensual:</strong> $45 USD</p>
                        <p><strong>Anual (15% off):</strong> $459 USD</p>
                        <p><strong>Dispositivo:</strong> $250 USD</p>
                    </div>
                </div>
            </div>

            <!-- Plan Avanzado -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-danger">
                    <div class="card-body">
                        <h4 class="card-title">🥇 Secure Pro</h4>
                        <p class="card-text"><strong>Para máxima protección</strong></p>
                        <ul class="list-unstyled text-start small">
                            <li>✔ Acceso ilimitado</li>
                            <li>✔ 3 capas: RFID + Cámara + Sensor</li>
                            <li>✔ Terminal de cambios</li>
                            <li>✔ Encriptación avanzada</li>
                            <li>✔ Soporte 24/7</li>
                            <li>➕ Consultoría incluida</li>
                        </ul>
                        <hr>
                        <p><strong>Mensual:</strong> $70 USD</p>
                        <p><strong>Anual (20% off):</strong> $672 USD</p>
                        <p><strong>Dispositivo:</strong> $350 USD</p>
                    </div>
                </div>
            </div>

            <!-- Plan Personalizado -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow border-dark">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="card-title">🛠️ Plan Personalizado</h4>
                            <p class="card-text"><strong>¿Necesitas algo especial?</strong></p>
                            <p class="small">Contáctanos para recibir una propuesta a medida, adaptada a tus necesidades específicas de seguridad y gestión.</p>
                        </div>
                        <a href="#contacto" class="btn btn-outline-dark mt-3">Solicitar Cotización</a>
                    </div>
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