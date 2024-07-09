<?php

// Parámetros de conexión
$host = "localhost";
$user = "root";
$pass = "root_js";
$dbname = "prueba";

// Crear la conexión
$connection = new mysqli($host, $user, $pass, $dbname);

// Verificar la conexión
if ($connection->connect_error) {
    die("Conexión fallida: " . $connection->connect_error);
}

// Establecer el conjunto de caracteres
$connection->set_charset("utf8");

// Puedes cerrar la conexión aquí si estás usando el archivo solo para la conexión
// $connection->close();
?>
