<?php

// Integración DB
require './connection.php';

// Verifica el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos
    $email_user = $connection->real_escape_string(trim($_POST['email_user']));
    $pass_user = $connection->real_escape_string(trim($_POST['pass_user']));

    // Encriptar la contraseña
    // $hashed_pass_user = password_hash($pass_user, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar los datos
    $stmt = $connection->prepare("INSERT INTO users (email_user, pass_user) VALUES (?, ?)");
    $stmt->bind_param("ss", $email_user, $pass_user);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $connection->close();
} else {
    echo "Método de solicitud no válido";
}
?>
