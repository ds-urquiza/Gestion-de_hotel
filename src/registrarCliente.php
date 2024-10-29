<?php
require 'Cliente.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        // Depuración
        error_log("Datos recibidos: nombre=$nombre, telefono=$telefono, email=$email");

        $cliente = new \Gestionhotel\Reservas\Cliente($nombre, $telefono, $email);
        $cliente->guardar();

        // Depuración
        error_log("Cliente registrado con éxito");
        header("Location: ../frontend/registrar-cliente.html?success=1");
    }
} catch (\PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
}



