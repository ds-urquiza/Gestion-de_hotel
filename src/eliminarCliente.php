<?php
require 'Cliente.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        // Instanciar la clase Cliente
        $cliente = new \Gestionhotel\Reservas\Cliente('', '', '');
        $cliente->eliminar($id);

        // Redirigir con un mensaje de éxito
        header("Location: ../frontend/clientes.html?success=1");
    }
} catch (\PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
}
?>

