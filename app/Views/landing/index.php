<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags -->
    <meta property="og:site_name" content="" />
    <meta property="og:site" content="" />
    <meta property="og:title" content=""/>
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta name="twitter:card" content="summary_large_image">

    <!-- Webpage Title -->
    <title>Desi Webpage Title</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/fontawesome-all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/swiper.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/styles.css') ?>" rel="stylesheet">
    
    <!-- Favicon  -->
    <link rel="icon" href="<?= base_url('images/favicon.png') ?>">
</head>
<body>
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation">
        <div class="container">

            <!-- Image Logo -->
            <a class="navbar-brand logo-image" href="<?= base_url() ?>"><img src="<?= base_url('images/logo.svg') ?>" alt="alternative"></a> 

            <!-- Resto del código de navegación... -->
            <!-- ... -->
        </div>
    </nav>

    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <!-- Contenido del header... -->
        </div>
        
        <!-- Video Background -->
        <video autoplay loop muted id="video-background" poster="<?= base_url('images/header-background.jpg') ?>" playsinline>
            <source src="<?= base_url('images/header-background-video.mp4') ?>" type="video/mp4" />
        </video>
    </header>

    <!-- Resto del contenido HTML... -->
    <!-- Todas las imágenes deben usar base_url() -->
    <img class="img-fluid" src="<?= base_url('images/services-1.jpg') ?>" alt="alternative">
    <img class="img-fluid" src="<?= base_url('images/services-2.jpg') ?>" alt="alternative">
    <!-- ... -->

    <!-- Scripts al final del body -->
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('js/swiper.min.js') ?>"></script>
    <script src="<?= base_url('js/purecounter.min.js') ?>"></script>
    <script src="<?= base_url('js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('js/scripts.js') ?>"></script>
</body>
</html>