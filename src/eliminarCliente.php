<?php
require 'Cliente.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        // Instanciar la clase Cliente
        $cliente = new \Gestionhotel\Reservas\Cliente('', '', '');
        $cliente->eliminar($id);

       // Enviar una respuesta de éxito
       echo json_encode(["status" => "success", "message" => "Cliente eliminado correctamente"]);
       exit; // Asegúrate de salir después de enviar la respuesta
    }
} catch (\PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Error al eliminar el cliente"]);
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Error al eliminar el cliente"]);
}
?>

