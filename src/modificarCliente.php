<?php
require 'Cliente.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        // Depuración
        error_log("Datos recibidos: id=$id, nombre=$nombre, telefono=$telefono, email=$email");

        // Instanciar la clase Cliente
        $cliente = new \Gestionhotel\Reservas\Cliente($nombre, $telefono, $email);

        // Llamar a un método para actualizar los datos
        $cliente->actualizar($id);

        // Redirigir con un mensaje de éxito
        header("Location: ../frontend/clientes.html?success=1");
    }
} catch (\PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    error_log("Error: " .$e->getMessage() );
}

?>
