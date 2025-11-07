<?php
$session=session();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de control de acceso inteligente para racks de servidores con RFID, sensores y cámaras. Seguridad de siguiente nivel.">
    <meta name="author" content="Federico Arias - Joel Martinez Vilche">
    <meta name="keywords" content="seguridad racks, control acceso RFID, protección servidores, sistema IoT seguridad, rackon, rackon sistema de seguridad">

    <meta property="og:title" content="RackON - Seguridad Inteligente para Racks">
    <meta property="og:description" content="Sistema IoT de seguridad para racks con acceso RFID y sensores.">
    <meta property="og:image" content="assets/images/RackON.jpg"> 
    <meta property="og:url" content="https://rackon.tech">
    <meta property="og:type" content="website">
    <title>Preguntas Frecuentes - RackON</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    
    <link href="https://unpkg.com/swiper@7/swiper-bundle.min.css" rel="stylesheet">
    
    <style>
    :root {
        --primary-color: #0d6efd;
        --primary-light: #e8f2ff;
        --dark-color: #2c3e50;
        --light-color: #ffffff;
        --light-bg: #f8f9fa;
        --text-color: #4a5568;
        --border-color: #e2e8f0;
    }
    
    /* Estilos base */
    body {
        font-family: 'Open Sans', sans-serif;
        color: var(--text-color);
        overflow-x: hidden;
        scroll-behavior: smooth;
        padding-top: 0;
        background-color: var(--light-color);
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
        color: var(--dark-color);
        font-weight: 600;
    }
    
    /* NAVBAR TRANSPARENTE */
    #navbar {
        padding: 1rem 1rem;
        background-color: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }
    
    /* Estado INICIAL (sin scroll) - letras OSCURAS */
    #navbar .navbar-brand,
    #navbar .nav-link,
    #navbar .navbar-toggler {
        color: #2d3748 !important;
    }
    
    #navbar .nav-link:hover,
    #navbar .nav-link.active {
        color: var(--primary-color) !important;
        background-color: var(--primary-light);
    }
    
    #navbar .btn-outline-light {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    #navbar .btn-outline-light:hover {
        background-color: var(--primary-color);
        color: white;
    }
    
    /* SECCIONES GENERALES */
    .fullpage-section {
        width: 100%;
        min-height: 100vh;
        padding: 80px 0;
        display: flex;
        align-items: center;
    }
    
    .section-title {
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .section-title h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .section-title .lead {
        font-size: 1.25rem;
        max-width: 800px;
        margin: 0 auto;
        color: var(--text-color);
    }
    
    /* FAQ SECTION */
    #faq {
        background-color: var(--light-bg);
        padding-top: 100px;
        padding-bottom: 80px;
    }
    
    .faq-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .faq-category {
        margin-bottom: 3rem;
    }
    
    .faq-category h3 {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-light);
    }
    
    .accordion-item {
        border: 1px solid var(--border-color);
        border-radius: 8px;
        margin-bottom: 1rem;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }
    
    .accordion-item:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    .accordion-button {
        background-color: var(--light-color);
        color: var(--dark-color);
        font-weight: 600;
        padding: 1.25rem 1.5rem;
        border: none;
        box-shadow: none;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: var(--primary-color);
    }
    
    .accordion-body {
        padding: 1.5rem;
        background-color: var(--light-color);
        border-top: 1px solid var(--border-color);
    }
    
    .accordion-body p:last-child {
        margin-bottom: 0;
    }
    
    .faq-icon {
        color: var(--primary-color);
        margin-right: 10px;
    }
    
    /* SECCIÓN CONTACTO */
    #contact {
        background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('assets/images/contact-background.jpg') center center no-repeat;
        background-size: cover;
        color: var(--dark-color);
    }
    
    .contact-form .form-control {
        background-color: rgba(255,255,255,0.8);
        border: 1px solid var(--border-color);
        color: var(--text-color);
        padding: 12px 15px;
        border-radius: 8px;
    }
    
    .contact-form .form-control::placeholder {
        color: #a0aec0;
    }

    #contact .section-title h2 {
        color: var(--dark-color) !important;
    }

    /* FOOTER */
    footer {
        background-color: var(--dark-color);
        color: #cbd5e0;
    }
    
    footer a {
        color: #cbd5e0;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    footer a:hover {
        color: white;
    }
    
    .social-icons a {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.1);
        margin-right: 0.5rem;
        transition: all 0.3s;
    }
    
    .social-icons a:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-3px);
    }
    
    /* BOTÓN SUBIR */
    #backToTop {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        z-index: 99;
        font-size: 20px;
        line-height: 1;
        background-color: var(--primary-color);
        border: none;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    
    #backToTop:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(13, 110, 253, 0.4);
    }
    
    /* ========================================= */
    /* MEDIA QUERIES PARA RESPONSIVE - MEJORADAS */
    /* ========================================= */
    
    /* Dispositivos medianos (tablets, 768px y más) */
    @media (min-width: 768px) {
        .section-title h2 {
            font-size: 3rem;
        }
    }
    
    /* Dispositivos pequeños (teléfonos, menos de 768px) - MEJORADO */
    @media (max-width: 767.98px) {
        body {
            padding-top: 0;
        }
        
        .section-title h2 {
            font-size: 2.2rem;
        }
        
        #navbar {
            padding: 0.75rem 1rem;
        }
        
        #navbar .navbar-brand img {
            height: 45px;
        }
        
        #navbar .navbar-collapse {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 1rem;
            margin: 0.5rem -1rem 0 -1rem;
            border-radius: 0 0 12px 12px;
            text-align: left;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        #navbar .navbar-nav {
            align-items: flex-start;
        }
        
        #navbar .nav-item {
            margin: 0.75rem 0;
            width: 100%;
        }
        
        #navbar .nav-link {
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
            display: block;
            color: var(--dark-color);
        }
        
        #navbar .btn-outline-light {
            margin: 1rem 0 0;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
            text-align: center;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .faq-container {
            padding: 0 15px;
        }
        
        .accordion-button {
            padding: 1rem 1.25rem;
            font-size: 1rem;
        }
        
        .accordion-body {
            padding: 1.25rem;
        }
        
        /* Ajustes generales */
        .fullpage-section {
            padding: 60px 0;
        }
        
        .section-title .lead {
            font-size: 1.1rem;
            padding: 0 15px;
        }
        
        .container, .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        /* Botón subir */
        #backToTop {
            width: 56px;
            height: 56px;
            font-size: 24px;
        }
    }
    
    /* Dispositivos muy pequeños (menos de 400px) - MEJORADO */
    @media (max-width: 400px) {
        #navbar .navbar-brand img {
            height: 40px;
        }
        
        .section-title h2 {
            font-size: 1.9rem;
        }
        
        .section-title .lead {
            font-size: 1rem;
        }
    }
    </style>
</head>
<body>
    
<nav id="navbar" class="navbar navbar-expand-lg navbar-light fixed-top py-2">
    <div class="container">
        <a class="navbar-brand" href="/">
            <!-- Aquí puedes agregar tu logo -->
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link px-2 px-lg-3 py-2" href="/" style="font-size: 1.1rem;">Inicio</a>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle px-2 px-lg-3 py-2" href="#" id="productoDropdown" 
                       role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                        Producto
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productoDropdown">
                        <li><h6 class="dropdown-header">Sobre RackON</h6></li>
                        <li><a class="dropdown-item py-2" href="/#introduction">
                            <i class="fas fa-question-circle me-2"></i>¿Qué es RackON?
                        </a></li>
                        <li><a class="dropdown-item py-2" href="/#funcionamiento">
                            <i class="fas fa-cogs me-2"></i>¿Cómo funciona?
                        </a></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <li><h6 class="dropdown-header">Componentes</h6></li>
                        <li><a class="dropdown-item py-2" href="/#hardware">
                            <i class="fas fa-microchip me-2"></i>Hardware
                        </a></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <li><a class="dropdown-item py-2" href="/#planes">
                            <i class="fas fa-tags me-2"></i>Planes y Precios
                        </a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-2 px-lg-3 py-2" href="/#contact" style="font-size: 1.1rem;">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active px-2 px-lg-3 py-2" href="/FAQ" style="font-size: 1.1rem;">FAQ</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-outline-light px-3 py-2" href="login" style="font-size: 1.1rem;">
                        <i class="fas fa-sign-in-alt me-2"></i>Acceder
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="faq" class="fullpage-section">
    <div class="container">
        <div class="section-title">
            <h2>Preguntas Frecuentes</h2>
            <p class="lead">Encuentra respuestas a las preguntas más comunes sobre RackON</p>
        </div>
        
        <div class="faq-container">
            <!-- Categoría: General -->
            <div class="faq-category">
                <h3><i class="fas fa-info-circle faq-icon"></i>General</h3>
                <div class="accordion" id="generalAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                ¿Qué es exactamente RackON?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#generalAccordion">
                            <div class="accordion-body">
                                RackON es un sistema inteligente de control de acceso físico diseñado específicamente para racks de servidores. Combina tecnologías como RFID, sensores de vibración y cámaras de vigilancia para ofrecer una solución de seguridad robusta y en capas que protege tus activos críticos.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                ¿Para qué tipo de empresas está diseñado RackON?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#generalAccordion">
                            <div class="accordion-body">
                                RackON está diseñado para cualquier organización que tenga racks de servidores y necesite mejorar su seguridad física. Esto incluye centros de datos, empresas de TI, instituciones financieras, hospitales, universidades y cualquier entidad que maneje datos sensibles o críticos.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                ¿Es compatible con cualquier tipo de rack?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#generalAccordion">
                            <div class="accordion-body">
                                Sí, RackON está diseñado para ser compatible con la mayoría de racks de servidores estándar del mercado. Nuestro sistema es adaptable y puede configurarse para diferentes tamaños y tipos de racks. Si tienes un caso específico, podemos evaluar la compatibilidad durante el proceso de consulta.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Categoría: Funcionalidad -->
            <div class="faq-category">
                <h3><i class="fas fa-cogs faq-icon"></i>Funcionalidad</h3>
                <div class="accordion" id="functionalityAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                ¿Cómo funciona el sistema de control de acceso RFID?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#functionalityAccordion">
                            <div class="accordion-body">
                                El sistema utiliza lectores RFID RC522 que validan tarjetas de acceso únicas para cada usuario autorizado. Cuando un usuario acerca su tarjeta al lector, el sistema verifica su identidad en la base de datos y, si está autorizado, registra el acceso y puede activar el mecanismo de desbloqueo del rack.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                ¿Qué tipo de eventos registra el sistema?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#functionalityAccordion">
                            <div class="accordion-body">
                                RackON registra todos los eventos de seguridad, incluyendo:
                                <ul>
                                    <li>Accesos válidos con RFID</li>
                                    <li>Intentos de acceso no autorizados</li>
                                    <li>Detectores de vibración o impacto</li>
                                    <li>Capturas de video o imágenes de accesos</li>
                                    <li>Cambios en la configuración del sistema</li>
                                </ul>
                                Todos estos eventos se almacenan con fecha, hora y detalles específicos.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                ¿Cómo se notifican los eventos sospechosos?
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#functionalityAccordion">
                            <div class="accordion-body">
                                El sistema puede configurarse para enviar notificaciones inmediatas a través de múltiples canales, incluyendo:
                                <ul>
                                    <li>Notificaciones push en la aplicación móvil</li>
                                    <li>Alertas por correo electrónico</li>
                                    <li>Mensajes SMS (opcional)</li>
                                    <li>Integración con sistemas de monitoreo existentes</li>
                                </ul>
                                Puedes personalizar qué tipos de eventos generan alertas y a quiénes se notifican.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Categoría: Instalación y Soporte -->
            <div class="faq-category">
                <h3><i class="fas fa-tools faq-icon"></i>Instalación y Soporte</h3>
                <div class="accordion" id="installationAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                ¿Qué incluye la instalación?
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#installationAccordion">
                            <div class="accordion-body">
                                La instalación estándar incluye:
                                <ul>
                                    <li>Montaje físico del hardware en el rack</li>
                                    <li>Conexión y configuración de todos los componentes</li>
                                    <li>Configuración inicial del software</li>
                                    <li>Creación de usuarios y permisos iniciales</li>
                                    <li>Pruebas de funcionamiento</li>
                                    <li>Capacitación básica para el personal</li>
                                </ul>
                                También ofrecemos opciones de instalación premium con asistencia remota o en sitio.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                ¿Qué tipos de soporte técnico ofrecen?
                            </button>
                        </h2>
                        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#installationAccordion">
                            <div class="accordion-body">
                                Ofrecemos tres niveles de soporte técnico:
                                <ul>
                                    <li><strong>Básico:</strong> Incluido con cada sistema - Soporte por correo electrónico y documentación completa</li>
                                    <li><strong>Premium:</strong> Soporte prioritario por correo y teléfono, tiempo de respuesta garantizado</li>
                                    <li><strong>Ultra:</strong> Incluye todo lo anterior más soporte remoto inmediato y visitas de mantenimiento programadas</li>
                                </ul>
                                Puedes personalizar tu plan de soporte según tus necesidades específicas.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                ¿Ofrecen mantenimiento preventivo?
                            </button>
                        </h2>
                        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#installationAccordion">
                            <div class="accordion-body">
                                Sí, ofrecemos planes de mantenimiento preventivo que incluyen:
                                <ul>
                                    <li>Actualizaciones de firmware y software</li>
                                    <li>Revisiones periódicas del sistema</li>
                                    <li>Verificación de sensores y componentes</li>
                                    <li>Informes de estado del sistema</li>
                                    <li>Optimizaciones de configuración</li>
                                </ul>
                                Estos planes están disponibles como parte de nuestros servicios de soporte Premium y Ultra.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Categoría: Precios y Compras -->
            <div class="faq-category">
                <h3><i class="fas fa-dollar-sign faq-icon"></i>Precios y Compras</h3>
                <div class="accordion" id="pricingAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                ¿Cuál es el precio base de RackON?
                            </button>
                        </h2>
                        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#pricingAccordion">
                            <div class="accordion-body">
                                El sistema RackON personalizado comienza desde 229 USD por unidad (pago único). Este precio incluye el hardware básico con control de acceso RFID. El precio final depende de las opciones de personalización que elijas, como cámaras, sensores de vibración, personalización estética y nivel de soporte técnico.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEleven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                ¿Ofrecen descuentos por volumen?
                            </button>
                        </h2>
                        <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#pricingAccordion">
                            <div class="accordion-body">
                                Sí, ofrecemos descuentos progresivos por volumen:
                                <ul>
                                    <li>1 unidad: 229 USD/unidad</li>
                                    <li>2-4 unidades: 219 USD/unidad</li>
                                    <li>5+ unidades: 199 USD/unidad</li>
                                </ul>
                                Para pedidos corporativos grandes (más de 10 unidades), podemos ofrecer condiciones personalizadas. Contáctanos para discutir tus necesidades específicas.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwelve">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                ¿Qué métodos de pago aceptan?
                            </button>
                        </h2>
                        <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#pricingAccordion">
                            <div class="accordion-body">
                                Aceptamos múltiples métodos de pago para adaptarnos a tus necesidades:
                                <ul>
                                    <li>Tarjetas de crédito/débito (Visa, MasterCard, American Express)</li>
                                    <li>PayPal</li>
                                    <li>Transferencias bancarias</li>
                                    <li>Pagos corporativos con factura</li>
                                    <li>Financiamiento a través de socios comerciales (para pedidos grandes)</li>
                                </ul>
                                Para empresas, también podemos establecer condiciones de pago personalizadas.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Categoría: Seguridad y Privacidad -->
            <div class="faq-category">
                <h3><i class="fas fa-shield-alt faq-icon"></i>Seguridad y Privacidad</h3>
                <div class="accordion" id="securityAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThirteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                ¿Dónde se almacenan los datos recopilados?
                            </button>
                        </h2>
                        <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#securityAccordion">
                            <div class="accordion-body">
                                Los datos se almacenan de forma segura según tu preferencia:
                                <ul>
                                    <li><strong>Almacenamiento local:</strong> Todos los datos permanecen en tus instalaciones en servidores locales</li>
                                    <li><strong>Almacenamiento en la nube:</strong> Datos cifrados almacenados en servidores seguros con certificación de seguridad</li>
                                    <li><strong>Híbrido:</strong> Combinación de almacenamiento local y en la nube según el tipo de datos</li>
                                </ul>
                                Cumplimos con las normativas de protección de datos aplicables y nunca compartimos información con terceros sin tu autorización explícita.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFourteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapseFourteen">
                                ¿Qué medidas de seguridad implementa el sistema?
                            </button>
                        </h2>
                        <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#securityAccordion">
                            <div class="accordion-body">
                                RackON implementa múltiples capas de seguridad:
                                <ul>
                                    <li>Cifrado de extremo a extremo para todas las comunicaciones</li>
                                    <li>Autenticación multifactor para accesos administrativos</li>
                                    <li>Registro detallado de auditoría de todos los eventos</li>
                                    <li>Controles de acceso basados en roles</li>
                                    <li>Actualizaciones de seguridad regulares</li>
                                    <li>Protección contra manipulaciones físicas</li>
                                </ul>
                                Además, realizamos pruebas de penetración periódicas para identificar y corregir posibles vulnerabilidades.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <p class="lead">¿No encontraste la respuesta que buscabas?</p>
            <a href="#contact" class="btn btn-primary btn-lg">
                <i class="fas fa-envelope me-2"></i>Contáctanos
            </a>
        </div>
    </div>
</section>

<section id="contact" class="fullpage-section">
    <div class="container">
        <div class="section-title">
            <h2>Contáctenos</h2>
            <p class="lead">Complete el formulario y nos pondremos en contacto con usted</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form id="contactForm" class="contact-form" action="https://formsubmit.co/RackOnOficial@gmail.com" method="POST">
                    <!-- Configuración avanzada -->
                    <input type="hidden" name="_captcha" value="false">
                    <input type="hidden" name="_template" value="table"> <!-- Más organizado -->
                    <input type="hidden" name="_subject" value="Consulta desde FAQ RackON"> <!-- Asunto personalizado -->
                    <input type="hidden" name="_autoresponse" value="Gracias por contactarnos. Hemos recibido tu mensaje y te responderemos pronto."> <!-- Autorespuesta -->
                    <input type="text" name="_honey" style="display:none"> <!-- Trampa para bots -->
                    
                    <!-- Campos del formulario -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="asunto" class="form-control" placeholder="Asunto" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
                    </div>
                    
                    <!-- Feedback para el usuario -->
                    <div id="formFeedback" class="alert d-none mb-3"></div>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <span id="submitText">Enviar Mensaje</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 style="color: white;">Sobre RackON</h5>
                <p>Ofrecemos soluciones innovadoras para la seguridad física de racks de servidores, utilizando tecnología de punta para proteger tus activos.</p>
            </div>
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 style="color: white;">Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/#introduction">¿Qué es?</a></li>
                    <li><a href="/#funcionamiento">Cómo Funciona</a></li>
                    <li><a href="/#hardware">Hardware</a></li>
                    <li><a href="/#planes">Planes</a></li>
                    <li><a href="/#contact">Contacto</a></li>
                    <li><a href="/FAQ">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 style="color: white;">Síguenos</h5>
                <div class="social-icons mb-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <h5 style="color: white;">Descarga la App</h5>
                <div class="app-badges">
                    <a href="#"><img src="assets/images/app.png" alt="App Store" class="img-fluid me-2" style="height: 40px;">App Store</a>
                    <a href="#"><img src="assets/images/playstore.png" alt="Google Play" class="img-fluid" style="height: 40px;">Google Play</a>
                </div>
            </div>
            <div class="col-lg-2">
                <h5 style="color: white;">Contacto</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt me-2"></i>Río Tercero, Córdoba, Argentina</li>
                    <li><i class="fas fa-envelope me-2"></i>rackonoficial@gmail.com</li>
                    <li><i class="fas fa-phone me-2"></i>+54 9 3571 XXXXXX</li>
                </ul>
            </div>
        </div>
        <hr class="mt-4 mb-3">
        <div class="row">
            <div class="col-12 text-center text-md-start">
                <center>
                <p class="mb-0 text-muted">&copy; 2025 RackON. Todos los derechos reservados.</p>
                </center>
            </div>
        </div>
    </div>
</footer>

<button id="backToTop" class="btn btn-primary" title="Volver arriba">
    <i class="fas fa-arrow-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
// ============================================
// NAVBAR SCROLL EFFECT
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('navbar');
    const backToTopButton = document.getElementById('backToTop');
    
    // Función para manejar el scroll
    function handleScroll() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Mostrar/ocultar botón "volver arriba"
        if (backToTopButton) {
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        }
    }
    
    // Ejecutar al cargar la página
    handleScroll();
    
    // Escuchar el evento scroll
    window.addEventListener('scroll', handleScroll);
    
    // Botón "volver arriba"
    if (backToTopButton) {
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

// ============================================
// FORMULARIO DE CONTACTO
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const feedback = document.getElementById('formFeedback');
            const spinner = document.getElementById('submitSpinner');
            const submitText = document.getElementById('submitText');
            
            // Mostrar spinner
            spinner.classList.remove('d-none');
            submitText.textContent = 'Enviando...';
            submitBtn.disabled = true;
            
            // Enviar formulario
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    feedback.textContent = '¡Mensaje enviado con éxito!';
                    feedback.classList.remove('alert-danger', 'd-none');
                    feedback.classList.add('alert-success');
                    form.reset();
                } else {
                    throw new Error('Error en el envío');
                }
            })
            .catch(error => {
                feedback.textContent = 'Error al enviar. Por favor, inténtalo de nuevo.';
                feedback.classList.remove('alert-success', 'd-none');
                feedback.classList.add('alert-danger');
            })
            .finally(() => {
                spinner.classList.add('d-none');
                submitText.textContent = 'Enviar Mensaje';
                submitBtn.disabled = false;
            });
        });
    }
});
</script>
</body>
</html>