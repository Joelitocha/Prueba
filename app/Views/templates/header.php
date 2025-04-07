<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'RackON - Control de Acceso RFID' ?></title>
    <meta name="description" content="<?= $description ?? 'Sistema profesional de control de acceso con tecnología RFID en Argentina' ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:title" content="<?= $og_title ?? $title ?? 'RackON' ?>">
    <meta property="og:description" content="<?= $og_description ?? $description ?? 'Soluciones RFID para gestión de accesos' ?>">
    <meta property="og:image" content="<?= base_url('assets/img/og-image.jpg') ?>">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
</head>