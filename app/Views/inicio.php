<?php
    $session = session();
    $rol = $session->get("ID_Rol");
?>

<!doctype html>
<html lang="es">
  <head>
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
      /* Estilos generales */
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
      
      body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
      }

      /* Botón para mostrar/ocultar menú en móviles */
      .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        background-color: #2c3e50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 15px;
        z-index: 1100;
        cursor: pointer;
        font-size: 18px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
      }

      /* Estilos para el Sidebar - Versión responsive */
      .sidebar {
        height: 100vh;
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #2c3e50;
        padding-top: 20px;
        color: #fff;
        box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        scrollbar-width: none;
        z-index: 1000;
        transition: transform 0.3s ease;
      }

      .sidebar::-webkit-scrollbar {
        display: none;
      }

      .sidebar a {
        padding: 12px 20px;
        text-decoration: none;
        font-size: 15px;
        color: #ecf0f1;
        display: flex;
        align-items: center;
        margin: 5px 10px;
        border-radius: 4px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      /* Efecto hover */
      .sidebar a:hover {
        background-color: #34495e;
        transform: translateX(5px);
      }

      /* Efecto para íconos */
      .sidebar a i {
        margin-right: 12px;
        font-size: 16px;
        color: #3498db;
        transition: all 0.3s ease;
        width: 20px;
        text-align: center;
      }

      .sidebar a:hover i {
        color: #ecf0f1;
      }

      /* Elemento activo */
      .sidebar a.active {
        background-color: #3498db;
        color: white;
      }

      .sidebar a.active i {
        color: white;
      }

      .sidebar .logo {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #ecf0f1;
        padding: 0 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .sidebar .logo .role {
        font-size: 14px;
        margin-top: 5px;
        color: #bdc3c7;
        font-weight: normal;
      }

      .sidebar .menu-heading {
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: bold;
        margin-top: 20px;
        font-size: 12px;
        color: #bdc3c7;
        letter-spacing: 1px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
      }

      /* Contenido principal */
      .content {
        margin-left: 250px;
        padding: 30px;
        transition: margin-left 0.3s ease;
        min-height: 100vh;
      }

      /* Tarjeta de bienvenida */
      .welcome-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        max-width: 1000px;
        margin: 30px auto;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        text-align: center;
      }

      .welcome-header h1 {
        font-size: 32px;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
      }

      .welcome-message p {
        font-size: 16px;
        color: #555;
        line-height: 1.7;
        margin-bottom: 30px;
      }

      /* Contenedor del toggle de empresa */
      .company-toggle-container {
        max-width: 500px;
        margin: 25px auto;
        position: relative;
      }

      /* Botón minimalista */
      .company-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        padding: 14px 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 1px solid #dee2e6;
        border-radius: 10px;
        color: #495057;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      .company-toggle-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.5s ease;
      }

      .company-toggle-btn:hover::before {
        left: 100%;
      }

      .company-toggle-btn:hover {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        border-color: #3498db;
        color: #2c3e50;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(52, 152, 219, 0.15);
      }

      .company-toggle-btn i:first-child {
        color: #3498db;
        font-size: 16px;
        transition: transform 0.3s ease;
      }

      .company-toggle-btn span {
        flex: 1;
        text-align: center;
      }

      .toggle-arrow {
        font-size: 12px;
        color: #6c757d;
        transition: all 0.3s ease;
      }

      /* Panel deslizante */
      .company-slide-panel {
        max-height: 0;
        overflow: hidden;
        background: #fff;
        border: 1px solid transparent;
        border-radius: 0 0 10px 10px;
        margin-top: -1px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        transform: translateY(-10px);
      }

      .company-slide-panel.active {
        max-height: 200px;
        border-color: #dee2e6;
        opacity: 1;
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      }

      .company-content {
        padding: 20px;
      }

      .company-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f8f9fa;
      }

      .company-info-item:last-child {
        border-bottom: none;
      }

      .company-label {
        font-size: 14px;
        color: #6c757d;
        font-weight: 500;
        flex: 1;
      }

      .company-value {
        font-size: 15px;
        color: #2c3e50;
        font-weight: 600;
        text-align: right;
        flex: 1;
        padding: 6px 12px;
        background: #f8f9fa;
        border-radius: 6px;
        border-left: 3px solid #3498db;
      }

      /* Estados activos */
      .company-toggle-container.active .toggle-arrow {
        transform: rotate(180deg);
        color: #3498db;
      }

      .company-toggle-container.active .company-toggle-btn {
        border-radius: 10px 10px 0 0;
        border-bottom-color: transparent;
        background: linear-gradient(135deg, #3498db 0%, #2c3e50 100%);
        color: white;
      }

      .company-toggle-container.active .company-toggle-btn i:first-child {
        color: white;
        transform: scale(1.1);
      }

      /* Grid de iconos estilo masonry/ladrillos */
      .masonry-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        grid-auto-rows: 120px;
        grid-gap: 20px;
        margin-top: 30px;
      }

      .masonry-item {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        cursor: pointer;
        text-decoration: none;
        position: relative;
        overflow: hidden;
      }

      /* Variación de alturas para efecto masonry */
      .masonry-item:nth-child(3n+1) {
        grid-row: span 2;
        height: 260px;
      }

      .masonry-item:nth-child(5n+2) {
        grid-row: span 1;
        height: 120px;
      }

      .masonry-item:nth-child(7n+3) {
        grid-row: span 3;
        height: 400px;
      }

      .masonry-item i {
        font-size: 32px;
        margin-bottom: 15px;
        color: #3498db;
        transition: all 0.3s ease;
      }

      .masonry-item p {
        font-size: 15px;
        color: #555;
        text-align: center;
        transition: all 0.3s ease;
      }

      .masonry-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        background-color: #3498db;
      }

      .masonry-item:hover i,
      .masonry-item:hover p {
        color: white;
      }

      /* Efecto de borde inferior al hover */
      .masonry-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background-color: #3498db;
        transform: scaleX(0);
        transition: transform 0.3s ease;
      }

      .masonry-item:hover::after {
        transform: scaleX(1);
      }

      /* Mensajes de error/éxito */
      .mensaje {
        padding: 12px 15px;
        margin: 15px 20px 15px 270px;
        border-radius: 4px;
        text-align: center;
        font-size: 15px;
        transition: margin-left 0.3s ease;
      }

      .error {
        color: #e74c3c;
        background-color: #fdecea;
        border: 1px solid #f5c6cb;
      }

      .success {
        color: #27ae60;
        background-color: #e8f5e9;
        border: 1px solid #c3e6cb;
      }

      /* Media Queries para responsive */
      @media (max-width: 1200px) {
        .masonry-grid {
          grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        }
      }

      @media (max-width: 992px) {
        .sidebar {
          transform: translateX(-100%);
        }
        
        .sidebar.active {
          transform: translateX(0);
        }
        
        .content {
          margin-left: 0;
        }
        
        .menu-toggle {
          display: block;
        }

        .mensaje {
          margin: 15px 20px;
        }

        .masonry-grid {
          grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
      }

      @media (max-width: 768px) {
        .welcome-container {
          padding: 30px;
          margin: 20px auto;
        }
        
        .welcome-header h1 {
          font-size: 26px;
        }
        
        .welcome-message p {
          font-size: 15px;
        }

        .masonry-item:nth-child(n) {
          grid-row: span 1;
          height: 120px;
        }

        .company-toggle-container {
          margin: 20px 15px;
          max-width: none;
        }
        
        .company-toggle-btn {
          padding: 12px 16px;
          font-size: 14px;
        }
        
        .company-content {
          padding: 15px;
        }
        
        .company-info-item {
          flex-direction: column;
          align-items: flex-start;
          gap: 8px;
          text-align: left;
        }
        
        .company-value {
          text-align: left;
          width: 100%;
          border-left: none;
          border-top: 3px solid #3498db;
        }
      }

      @media (max-width: 576px) {
        .sidebar {
          width: 220px;
        }
        
        .sidebar a {
          padding: 10px 15px;
          font-size: 14px;
        }
        
        .sidebar .logo {
          font-size: 20px;
        }
        
        .welcome-container {
          padding: 20px;
          margin: 15px;
        }
        
        .welcome-header h1 {
          font-size: 22px;
        }

        .masonry-grid {
          grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
          grid-auto-rows: 100px;
        }

        .masonry-item {
          padding: 15px;
        }

        .masonry-item i {
          font-size: 24px;
          margin-bottom: 10px;
        }

        .masonry-item p {
          font-size: 13px;
        }

        .company-toggle-btn {
          padding: 10px 14px;
          font-size: 13px;
          gap: 8px;
        }
        
        .company-toggle-btn i:first-child {
          font-size: 14px;
        }
        
        .company-content {
          padding: 12px;
        }
        
        .company-label {
          font-size: 13px;
        }
        
        .company-value {
          font-size: 14px;
          padding: 5px 10px;
        }
      }
/* Efectos de carga y transiciones */
.carousel-slide {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Efectos hover mejorados para masonry items */
.masonry-item {
    position: relative;
    overflow: hidden;
}

.masonry-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.masonry-item:hover::before {
    left: 100%;
}

/* Mejoras en los botones del sidebar */
.sidebar a::after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 3px;
    background: #3498db;
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.sidebar a:hover::after,
.sidebar a.active::after {
    transform: scaleY(1);
}

/* Efectos para los indicadores del carrusel */
.carousel-indicator {
    position: relative;
    overflow: hidden;
}

.carousel-indicator::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: #3498db;
    border-radius: 50%;
    transition: left 0.3s ease;
}

.carousel-indicator.active::before {
    left: 0;
}

/* Mejoras en los botones de navegación del carrusel */
.carousel-nav {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.carousel-nav::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.carousel-nav:hover::before {
    opacity: 1;
}

/* Efectos de sombra mejorados */
.carousel-container {
    position: relative;
}

.carousel-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(52, 152, 219, 0.3), transparent);
}

/* Mejoras en la tipografía */
.welcome-header h1 {
    position: relative;
    display: inline-block;
}

.welcome-header h1::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background: #3498db;
    border-radius: 2px;
}

/* Efectos de profundidad para company details */
.company-detail-item {
    position: relative;
    transition: all 0.3s ease;
}

.company-detail-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.company-detail-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 10px;
    background: linear-gradient(135deg, rgba(52, 152, 219, 0.1) 0%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.company-detail-item:hover::before {
    opacity: 1;
}

/* Animaciones para el icono de la empresa */
.company-icon {
    position: relative;
    transition: all 0.3s ease;
}

.company-icon:hover {
    transform: scale(1.05) rotate(5deg);
}

.company-icon::before {
    content: '';
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    background: linear-gradient(135deg, #3498db, #2c3e50);
    border-radius: 50%;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.company-icon:hover::before {
    opacity: 0.1;
}

/* Mejoras en la responsividad para tablets */
@media (max-width: 1024px) {
    .carousel-container {
        max-width: 900px;
    }
    
    .masonry-grid {
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    }
    
    .company-details {
        max-width: 350px;
    }
}

/* Mejoras para móviles en landscape */
@media (max-width: 896px) and (orientation: landscape) {
    .carousel-container {
        min-height: 300px;
    }
    
    .carousel-slide {
        min-height: 300px;
        padding: 20px;
    }
    
    .masonry-grid {
        grid-auto-rows: 80px;
    }
    
    .masonry-item {
        padding: 10px;
    }
}

/* Soporte para dispositivos con pantalla muy pequeña */
@media (max-width: 360px) {
    .carousel-container {
        margin: 10px;
        min-height: 300px;
    }
    
    .carousel-slide {
        padding: 15px;
        min-height: 300px;
    }
    
    .welcome-header h1 {
        font-size: 20px;
    }
    
    .company-title {
        font-size: 18px;
    }
    
    .company-detail-item {
        padding: 12px;
    }
    
    .masonry-grid {
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        grid-auto-rows: 80px;
    }
    
    .masonry-item i {
        font-size: 20px;
    }
    
    .masonry-item p {
        font-size: 11px;
    }
}

/* Mejoras de accesibilidad */
@media (prefers-reduced-motion: reduce) {
    .carousel-slide,
    .masonry-item,
    .company-detail-item,
    .carousel-nav,
    .sidebar a {
        transition: none;
    }
    
    .masonry-item:hover,
    .company-detail-item:hover {
        transform: none;
    }
}

/* Modo oscuro del sistema */
@media (prefers-color-scheme: dark) {
    .carousel-container {
        background-color: #2c3e50;
        color: #ecf0f1;
    }
    
    .welcome-header h1,
    .company-title {
        color: #ecf0f1;
    }
    
    .welcome-message p {
        color: #bdc3c7;
    }
    
    .masonry-item {
        background-color: #34495e;
    }
    
    .masonry-item p {
        color: #ecf0f1;
    }
    
    .company-detail-item {
        background-color: #34495e;
    }
    
    .company-detail-value {
        color: #ecf0f1;
    }
}

/* Estilos para estados de foco (accesibilidad) */
.carousel-nav:focus,
.masonry-item:focus,
.sidebar a:focus {
    outline: 2px solid #3498db;
    outline-offset: 2px;
}

/* Mejoras en las transiciones del carrusel */
.carousel-slide {
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.carousel-slide:not(.active) {
    transform: translateX(100%);
}

.carousel-slide.active {
    transform: translateX(0);
}

.carousel-slide.prev {
    transform: translateX(-100%);
}

/* Efectos de overlay para imágenes (si se agregaran en el futuro) */
.masonry-item.with-image {
    position: relative;
}

.masonry-item.with-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(52, 152, 219, 0.8), rgba(44, 62, 80, 0.8));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.masonry-item.with-image:hover::after {
    opacity: 1;
}

/* Estados de carga */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% {
        left: -100%;
    }
    100% {
        left: 100%;
    }
}

/* Scrollbar personalizado para navegadores webkit */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: #3498db;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #2980b9;
}

/* Mejoras para el contenedor principal en pantallas muy grandes */
@media (min-width: 1600px) {
    .carousel-container {
        max-width: 1200px;
    }
    
    .masonry-grid {
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        grid-auto-rows: 140px;
    }
    
    .masonry-item:nth-child(3n+1) {
        height: 300px;
    }
    
    .masonry-item:nth-child(7n+3) {
        height: 460px;
    }
}

/* Estilos para impresión */
@media print {
    .sidebar,
    .menu-toggle,
    .carousel-nav,
    .carousel-indicators {
        display: none !important;
    }
    
    .content {
        margin-left: 0 !important;
    }
    
    .carousel-container {
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
    
    .masonry-item {
        break-inside: avoid;
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
}

/* Soporte para navegadores antiguos */
@supports not (display: grid) {
    .masonry-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .masonry-item {
        width: 180px;
        margin: 10px;
        height: 120px;
    }
    
    /* Alturas específicas para mantener el efecto visual */
    .masonry-item:nth-child(3n+1) {
        height: 260px;
    }
    
    .masonry-item:nth-child(7n+3) {
        height: 400px;
    }
}

/* Mejoras en la visualización de textos largos */
.company-detail-value,
.welcome-message p {
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Efectos de parallax sutiles */
.carousel-container {
    transform-style: preserve-3d;
    perspective: 1000px;
}

.carousel-slide {
    transform-style: preserve-3d;
}

/* Estados de error y éxito mejorados */
.mensaje {
    position: relative;
    padding-left: 50px;
}

.mensaje::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    background-size: contain;
    background-repeat: no-repeat;
}

.mensaje.error::before {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23e74c3c'%3E%3Cpath d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z'/%3E%3C/svg%3E");
}

.mensaje.success::before {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%2327ae60'%3E%3Cpath d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z'/%3E%3C/svg%3E");
}
    </style>
  </head>
  <body>
    <!-- Botón para mostrar/ocultar menú en móviles -->
    <button class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars"></i> Menú
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="logo">
        <?php 
          if ($rol == 5) {
              echo "Panel de Control";
              echo '<span class="role">Administrador</span>';
          } elseif ($rol == 6) {
              echo "Panel Supervisor";
              echo '<span class="role">Supervisor</span>';
          } elseif ($rol == 7) {
              echo "Bienvenido";
              echo '<span class="role">Usuario</span>';
          }
        ?>
      </div>

      <a href="<?php echo site_url('/bienvenido');?>" class="menu-item active">
        <i class="fas fa-home"></i> Inicio
      </a>
      
      <!-- Opciones para Administrador -->
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Administración</div>
      <a href="<?php echo site_url('/modificar-usuario');?>" class="menu-item">
        <i class="fas fa-users-cog"></i> Gestión de Usuarios
      </a>
      <?php endif; ?>
      
      <!-- Opciones para Tarjetas -->
      <div class="menu-heading">Tarjetas RFID</div>
      <?php if ($rol == 5): ?>
      <a href="<?php echo site_url('/modificar-tarjeta');?>" class="menu-item">
        <i class="fas fa-credit-card"></i> Gestión de Tarjetas
      </a>
      <?php endif; ?>
      <a href="<?php echo site_url('/consultar-rfid');?>" class="menu-item">
        <i class="fas fa-search"></i> Consultar Estado
      </a>
      
      <!-- Opciones para Dispositivos -->
      <?php if ($rol == 5): ?>
      <div class="menu-heading">Dispositivos</div>
      <a href="<?php echo site_url('/dispositivo');?>" class="menu-item">
      <i class="fas fa-network-wired"></i> Gestionar Dispositivos
      </a>
      <?php endif; ?>

      <!-- Opciones para Supervisor y Administrador -->
      <?php if ($rol == 5 || $rol == 6): ?>
      <div class="menu-heading">Reportes</div>
      <a href="<?php echo site_url('/ver-alertas');?>" class="menu-item">
        <i class="fas fa-bell"></i> Alertas
      </a>
      <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="menu-item">
        <i class="fas fa-door-open"></i> Accesos
      </a>
      <a href="<?php echo site_url('/historial-cambios');?>" class="menu-item">
        <i class="fas fa-history"></i> Historial
      </a>
      <?php endif; ?>
      
      <div class="menu-heading">Cuenta</div>
      <a onclick="cerrarsesion('<?php echo site_url('/logout');?>')" class="menu-item">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
      </a>
    </div>

    <!-- Contenido principal -->
    <div class="content">
      <!-- Carrusel principal -->
      <div class="carousel-container">
        <!-- Slide de Bienvenida -->
        <div class="carousel-slide active" id="slide-welcome">
          <div class="welcome-header">
            <h1>Bienvenido/a al Sistema</h1>
          </div>
          <div class="welcome-message">
            <?php 
            if ($rol == 5) {
                echo "<p>Hola Administrador, desde aquí puedes acceder a: Gestión de Usuarios - Gestión de Tarjetas - Dispositivos - Alertas del Sistema - Historial Completo - Control de Accesos</p>";
            } elseif ($rol == 6) {
                echo "<p>Hola Supervisor, desde aquí puedes acceder a: Consultar Estado - Alertas Recientes - Registro de Accesos - Historial de Cambios</p>";
            } elseif ($rol == 7) {
                echo "<p>Hola Usuario, desde aquí puedes acceder a: Consultar Estado</p>";
            }
            ?>
          </div>
          
          <div class="masonry-grid">
            <?php if ($rol == 5): ?>
              <!-- Iconos para Administrador -->
              <a href="<?php echo site_url('/modificar-usuario');?>" class="masonry-item">
                <i class="fas fa-users-cog"></i>
                <p>Gestión de Usuarios</p>
              </a>
              <a href="<?php echo site_url('/modificar-tarjeta');?>" class="masonry-item">
                <i class="fas fa-id-card"></i>
                <p>Gestión de Tarjetas</p>
              </a>
              <a href="<?php echo site_url('/consultar-rfid');?>" class="masonry-item">
                <i class="fas fa-money-check"></i>
                <p>Consultar Estado de la Tarjeta</p>
              </a>
              <a href="<?php echo site_url('/dispositivo');?>" class="masonry-item">
                <i class="fas fa-server"></i>
                <p>Dispositivos</p>
              </a>
              <a href="<?php echo site_url('/ver-alertas');?>" class="masonry-item">
                <i class="fas fa-exclamation-triangle"></i>
                <p>Alertas del Sistema</p>
              </a>
              <a href="<?php echo site_url('/historial-cambios');?>" class="masonry-item">
                <i class="fas fa-history"></i>
                <p>Historial Completo</p>
              </a>
              <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="masonry-item">
                <i class="fas fa-door-open"></i>
                <p>Control de Accesos</p>
              </a>
              
            <?php elseif ($rol == 6): ?>
              <!-- Iconos para Supervisor -->
              <a href="<?php echo site_url('/consultar-rfid');?>" class="masonry-item">
                <i class="fas fa-search"></i>
                <p>Consultar Estado</p>
              </a>
              <a href="<?php echo site_url('/ver-alertas');?>" class="masonry-item">
                <i class="fas fa-bell"></i>
                <p>Alertas Recientes</p>
              </a>
              <a href="<?php echo site_url('/ver-accesos-tarjeta');?>" class="masonry-item">
                <i class="fas fa-door-open"></i>
                <p>Registro de Accesos</p>
              </a>
              <a href="<?php echo site_url('/historial-cambios');?>" class="masonry-item">
                <i class="fas fa-history"></i>
                <p>Historial de Cambios</p>
              </a>

            <?php elseif ($rol == 7): ?>
              <!-- Iconos para Usuario -->
              <a href="<?php echo site_url('/consultar-rfid');?>" class="masonry-item">
                <i class="fas fa-search"></i>
                <p>Consultar Estado</p>
              </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Slide de Información de la Empresa -->
        <div class="carousel-slide company-info-slide" id="slide-company">
          <div class="company-icon">
            <i class="fas fa-building"></i>
          </div>
          <h2 class="company-title">Información de la Empresa</h2>
          <div class="company-details">
            <div class="company-detail-item">
              <div class="company-detail-label">Nombre de la empresa</div>
              <div class="company-detail-value"><?php echo session()->get('enombre'); ?></div>
            </div>
            <div class="company-detail-item">
              <div class="company-detail-label">Código de la empresa</div>
              <div class="company-detail-value"><?php echo session()->get('ecode'); ?></div>
            </div>
          </div>
        </div>

        <!-- Botones de navegación -->
        <button class="carousel-nav prev" onclick="prevSlide()">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-nav next" onclick="nextSlide()">
          <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Indicadores -->
        <div class="carousel-indicators">
          <div class="carousel-indicator active" onclick="goToSlide(0)"></div>
          <div class="carousel-indicator" onclick="goToSlide(1)"></div>
        </div>
      </div>
    </div>

    <script>
      // Mostrar/ocultar sidebar en móviles
      const menuToggle = document.getElementById('menuToggle');
      const sidebar = document.getElementById('sidebar');
      
      menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
      });

      // Cerrar sidebar al hacer clic en un enlace (en móviles)
      const menuItems = document.querySelectorAll('.sidebar a');
      menuItems.forEach(item => {
        item.addEventListener('click', () => {
          if (window.innerWidth <= 992) {
            sidebar.classList.remove('active');
          }
        });
      });

      // Cerrar sesión
      function cerrarsesion(url){
        if(confirm('¿Estás seguro de que deseas cerrar sesión?')){
          window.location.href=url;
        }
      }

      // Redimensionar la ventana
      window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
          sidebar.classList.remove('active');
        }
      });

      // Ajustar automáticamente el grid masonry
      function resizeMasonryItem(item){
        const grid = document.querySelector('.masonry-grid');
        const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
        const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        const contentHeight = item.querySelector('.masonry-content').getBoundingClientRect().height;
        const rowSpan = Math.ceil((contentHeight + rowGap) / (rowHeight + rowGap));
        item.style.gridRowEnd = 'span '+rowSpan;
      }

      function resizeAllMasonryItems(){
        const allItems = document.querySelectorAll('.masonry-item');
        allItems.forEach(item => {
          resizeMasonryItem(item);
        });
      }

      // Ejecutar al cargar y al redimensionar
      window.addEventListener('load', resizeAllMasonryItems);
      window.addEventListener('resize', resizeAllMasonryItems);

      // Mostrar/ocultar sidebar en móviles
      const menuToggle = document.getElementById('menuToggle');
      const sidebar = document.getElementById('sidebar');
      
      menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
      });

      // Cerrar sidebar al hacer clic en un enlace (en móviles)
      const menuItems = document.querySelectorAll('.sidebar a');
      menuItems.forEach(item => {
        item.addEventListener('click', () => {
          if (window.innerWidth <= 992) {
            sidebar.classList.remove('active');
          }
        });
      });

      // Cerrar sesión
      function cerrarsesion(url){
        if(confirm('¿Estás seguro de que deseas cerrar sesión?')){
          window.location.href=url;
        }
      }

      // Redimensionar la ventana
      window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
          sidebar.classList.remove('active');
        }
      });

      // Funcionalidad del carrusel
      let currentSlide = 0;
      const slides = document.querySelectorAll('.carousel-slide');
      const indicators = document.querySelectorAll('.carousel-indicator');

      function showSlide(index) {
        // Ocultar todos los slides
        slides.forEach(slide => {
          slide.classList.remove('active');
        });
        
        // Remover active de todos los indicadores
        indicators.forEach(indicator => {
          indicator.classList.remove('active');
        });
        
        // Mostrar slide actual y activar indicador
        slides[index].classList.add('active');
        indicators[index].classList.add('active');
        
        currentSlide = index;
      }

      function nextSlide() {
        let next = currentSlide + 1;
        if (next >= slides.length) {
          next = 0;
        }
        showSlide(next);
      }

      function prevSlide() {
        let prev = currentSlide - 1;
        if (prev < 0) {
          prev = slides.length - 1;
        }
        showSlide(prev);
      }

      function goToSlide(index) {
        showSlide(index);
      }

      // Navegación con teclado
      document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
          prevSlide();
        } else if (e.key === 'ArrowRight') {
          nextSlide();
        }
      });

      // Ajustar automáticamente el grid masonry
      function resizeMasonryItem(item){
        const grid = document.querySelector('.masonry-grid');
        const rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
        const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        const contentHeight = item.querySelector('.masonry-content').getBoundingClientRect().height;
        const rowSpan = Math.ceil((contentHeight + rowGap) / (rowHeight + rowGap));
        item.style.gridRowEnd = 'span '+rowSpan;
      }

      function resizeAllMasonryItems(){
        const allItems = document.querySelectorAll('.masonry-item');
        allItems.forEach(item => {
          resizeMasonryItem(item);
        });
      }

      // Ejecutar al cargar y al redimensionar
      window.addEventListener('load', resizeAllMasonryItems);
      window.addEventListener('resize', resizeAllMasonryItems);
    </script>

    <?php
      if (isset($error)) {
        echo '<div class="mensaje error">'.$error.'</div>';
      } elseif (isset($success)) {
        echo '<div class="mensaje success">'.$success.'</div>';
      }
    ?>
  </body>
</html>