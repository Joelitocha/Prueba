<?php

require 'vendor/autoload.php';

use Config\Database;

$db = Database::connect();

if ($db->connect()) {
    echo "✅ Conexión exitosa a la base de datos.";
} else {
    echo "❌ Error de conexión.";
}


