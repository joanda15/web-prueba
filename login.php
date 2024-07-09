<?php

// Incluir el archivo de conexión
require './connection.php';

// Verificar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos
    $email_user = $connection->real_escape_string(trim($_POST['email_user']));
    $pass_user = trim($_POST['pass_user']);

    // Preparar la consulta para obtener el usuario
    $stmt = $connection->prepare("SELECT pass_user FROM users WHERE email_user = ?");
    $stmt->bind_param("s", $email_user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_pass_user);
        $stmt->fetch();

        // Verificar la contraseña ingresada
        if (password_verify($pass_user, $hashed_pass_user)) {
            echo "Inicio de sesión exitoso";
        } else {
            echo "Email o contraseña incorrectos";
        }
    } else {
        echo "Email no registrado";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $connection->close();
} else {
    echo "Método de solicitud no válido";
}
?>
