<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Sistema de control de acceso inteligente para racks de servidores con RFID, sensores y cámaras. Seguridad de siguiente nivel.">
    <meta name="author" content="Federico Arias - Joel Martinez Vilche">

    <!-- OG Meta Tags -->
    <meta property="og:site_name" content="" />
    <meta property="og:site" content="" />
    <meta property="og:title" content=""/>
    <meta property="og:description" content="" />
    <meta property="og:image" content="<?= base_url('assets/images/header-background.jpg') ?>" />
    <meta property="og:url" content="" />
    <meta name="twitter:card" content="summary_large_image">

    <!-- Webpage Title -->
    <title>RackON - Rack Security</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/fontawesome-all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/swiper.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/styles.css') ?>" rel="stylesheet">
    
    <!-- Favicon  -->
    <link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>">
</head>
<body>
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation">
        <div class="container">

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo.svg') ?>" alt="alternative"></a> 

            <!-- Text Logo -->
            <!-- <a class="navbar-brand logo-text" href="<?= base_url() ?>">RackON</a> -->

            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ms-auto navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#header">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#introduction">¿Qué es RackON?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#hardware-utilizado">Hardware Utilizado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contactar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login">Acceder al Sistema</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end of navigation -->

      
    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="h1-large">Creative Social Media Digital Agency</h1>
                        <a class="btn-solid-lg" href="#introduction">Discover</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Video Background -->
        <video autoplay loop muted id="video-background" poster="<?= base_url('assets/images/rackon-og.jpg') ?>" playsinline>
            <source src="<?= base_url('assets/images/rackon-og.jpg') ?>" type="video/mp4" />
        </video>
        <!-- end of video background -->

    </header>
    <!-- end of header -->


<!-- Introduction -->
<div id="introduction" class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="h2-heading">¿Qué es RackON?</h2>
                <p class="p-heading">
                    <strong>RackON</strong> es un sistema inteligente de control de acceso físico diseñado para racks de servidores. 
                    Combina tecnologías como RFID, sensores de vibración y cámaras de vigilancia para ofrecer una solución de seguridad robusta y en capas.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <!-- Card -->
                <div class="card">
                    <div class="card-icon">
                        <span class="fas fa-id-card"></span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Identificación RFID</h4>
                        <div class="card-text">
                            Permite validar el acceso mediante tarjetas RFID, registrando quién accede al rack y cuándo lo hace.
                        </div>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-icon">
                        <span class="fas fa-bolt"></span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Detección de Vibración</h4>
                        <div class="card-text">
                            Añade un nivel extra de seguridad detectando intentos de manipulación física o golpes no autorizados.
                        </div>
                    </div>
                </div>
                <!-- end of card -->

                <!-- Card -->
                <div class="card">
                    <div class="card-icon">
                        <span class="fas fa-video"></span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Monitoreo por Cámara</h4>
                        <div class="card-text">
                            Captura imágenes o video del acceso en tiempo real, permitiendo una supervisión visual directa del entorno del rack.
                        </div>
                    </div>
                </div>
                <!-- end of card -->

            </div>
        </div>
    </div>
</div>
<!-- end of introduction -->



    <!-- Details -->
    <div class="split">
        <div class="area-1">
        </div><div class="area-2 bg-gray">
          <section id="que-es-rackon" class="py-5 bg-light">
            <div class="container">    
                <div class="row">
                    <div class="col-lg-12">     
                        <!-- Text Container -->
                        <div class="text-container">
                        <h2 class="mb-4">¿Qué es RackON?</h2>
                            <p class="lead">
                                <strong>RackON</strong> es un sistema de control de acceso inteligente para racks de servidores, diseñado como solución integral de seguridad física. 
                                Utiliza tecnología RFID, sensores de vibración y cámaras para ofrecer tres niveles de seguridad. 
                                El sistema permite administrar accesos, monitorear eventos en tiempo real y gestionar usuarios a través de una plataforma web con roles diferenciados.
                            </p>
                        </div>
                        <!-- end of text container -->
                    </div>
                </div>
            </div>
          </section>
        </div>
    </div>
    <!-- end of details -->

    <!-- Hardware Utilizado -->
<section id="hardware-utilizado" class="py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col-lg-12">
                <h2 class="mb-3">Hardware Utilizado</h2>
                <p class="lead">Los siguientes dispositivos permiten implementar los tres niveles de seguridad del sistema RackON.</p>
            </div>
        </div>
        <div class="row text-center">

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-microchip fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">ESP32</h5>
                        <p class="card-text">Microcontrolador principal que gestiona la lectura de tarjetas RFID, sensores y comunicación con la base de datos.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-id-card fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Lector RFID RC522</h5>
                        <p class="card-text">Dispositivo de lectura de tarjetas para autenticar el acceso físico al rack mediante identificación por radiofrecuencia.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-bolt fa-3x mb-3 text-danger"></i>
                        <h5 class="card-title">Sensor de Vibración</h5>
                        <p class="card-text">Detecta intentos de manipulación física del rack, como golpes o movimientos bruscos no autorizados.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-video fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Cámara de Vigilancia</h5>
                        <p class="card-text">Captura imágenes o video del acceso en tiempo real, permitiendo registrar eventos sospechosos visualmente.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-lock fa-3x mb-3 text-dark"></i>
                        <h5 class="card-title">Mecanismo de Bloqueo</h5>
                        <p class="card-text">Sistema electromecánico que permite o deniega el acceso al rack físicamente tras la validación.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



    <!-- Testimonials -->
    <div class="slider-1">
        <img class="text-decoration img-fluid" src="<?= base_url('assets/images/testimonials-decoration.png') ?>" alt="alternative">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card Slider -->
                    <div class="slider-container">
                        <div class="swiper-container card-slider">
                            <div class="swiper-wrapper">
                                
                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="<?= base_url('assets/images/testimonial-1.jpg') ?>" alt="alternative">
                                    <p class="testimonial-text">"Expense bed any sister depend changer off piqued one. Contented continued any happiness instantly objection yet her allowance. Use correct day new brought tedious. By come this been in. Kept easy or sons my it how about some words here done"</p>
                                    <div class="testimonial-author">Marlene Visconte</div>
                                    <div class="testimonial-position">General Manager - Scouter</div>
                                </div>
                                <!-- end of slide -->
        
                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="<?= base_url('assets/images/testimonial-2.jpg') ?>" alt="alternative">
                                    <p class="testimonial-text">"Expense bed any sister depend changer off piqued one. Contented continued any happiness instantly objection yet her allowance. Use correct day new brought tedious. By come this been in. Kept easy or sons my it how about some words here done"</p>
                                    <div class="testimonial-author">John Spiker</div>
                                    <div class="testimonial-position">Team Leader - Vanquish</div>
                                </div>
                                <!-- end of slide -->
        
                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <img class="testimonial-image" src="<?= base_url('assets/images/testimonial-3.jpg') ?>" alt="alternative">
                                    <p class="testimonial-text">"Expense bed any sister depend changer off piqued one. Contented continued any happiness instantly objection yet her allowance. Use correct day new brought tedious. By come this been in. Kept easy or sons my it how about some words here done"</p>
                                    <div class="testimonial-author">Stella Virtuoso</div>
                                    <div class="testimonial-position">Design Chief - Bikegirl</div>
                                </div>
                                <!-- end of slide -->
        
                            </div>
        
                            <!-- Add Arrows -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <!-- end of add arrows -->
        
                        </div>
                    </div>
                    <!-- end of card slider -->

                </div>
            </div>
        </div>
    </div>
    <!-- end of testimonials -->


    <!-- Statistics -->
    <div class="counter bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                    <!-- Counter -->
                    <div class="counter-container">
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="231" data-purecounter-duration="3" class="purecounter">1</div>
                            <div class="counter-info">Happy Customers</div>
                        </div>
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="385" data-purecounter-duration="1.5" class="purecounter">1</div>
                            <div class="counter-info">Issues Solved</div>
                        </div>
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="159" data-purecounter-duration="3" class="purecounter">1</div>
                            <div class="counter-info">Good Reviews</div>
                        </div>
                        <div class="counter-cell">
                            <div data-purecounter-start="0" data-purecounter-end="128" data-purecounter-duration="3" class="purecounter">1</div>
                            <div class="counter-info">Case Studies</div>
                        </div>
                    </div>
                    <!-- end of counter -->

                </div>
            </div>
        </div>
    </div>
    <!-- end of statistics -->


    <!-- Contact -->
    <div id="contact" class="form-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">Contact details</h2>
                    <p class="p-heading">Of will at sell well at as. Too want but tall nay like old removing yourself today</p>
                    <ul class="list-unstyled li-space-lg">
                        <li><i class="fas fa-map-marker-alt"></i> &nbsp;22 Innovative, San Francisco, CA 94043, US</li>
                        <li><i class="fas fa-phone"></i> &nbsp;<a href="tel:00817202212">+81 720 2212</a></li>
                        <li><i class="fas fa-envelope"></i> &nbsp;<a href="mailto:contact@site.com">contact@site.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    
                    <!-- Contact Form -->
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control-input" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control-input" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control-textarea" placeholder="Message" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control-submit-button">Submit</button>
                        </div>
                    </form>
                    <!-- end of contact form -->

                </div>
            </div>
        </div>
    </div>
    <!-- end of contact -->


    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-col first">
                        <h6>About Desi</h6>
                        <p class="p-small">He oppose at thrown desire of no. Announcing impression unaffected day his are unreserved indulgence. Him hard find read are you</p>
                    </div>
                    <div class="footer-col second">
                        <h6>Links</h6>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li>Important: <a href="<?= base_url('terms') ?>">Terms & Conditions</a>, <a href="<?= base_url('privacy') ?>">Privacy Policy</a></li>
                            <li>Useful: <a href="#">Colorpicker</a>, <a href="#">Icon Library</a>, <a href="#">Illustrations</a></li>
                            <li>Menu: <a href="#header">Home</a>, <a href="#services">Services</a>, <a href="#projects">Projects</a>, <a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    <div class="footer-col third">
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-pinterest-p fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a href="#your-link">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <p class="p-small">We would love to hear from you <a href="mailto:contact@site.com"><strong>contact@site.com</strong></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © <a href="#your-link">Your name</a></p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Distributed by:  <a href="https://themewagon.com/" target="_blank">Themewagon</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- end of copyright -->
    

    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn">
        <img src="<?= base_url('assets/images/up-arrow.png') ?>" alt="alternative">
    </button>
    <!-- end of back to top button -->
        
    <!-- Scripts -->
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/swiper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/purecounter.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
</body>
</html>