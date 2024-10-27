<?php
try {
    // Conexión a la base de datos SQLite
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear nueva reserva
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cliente = $_POST['cliente'];
        $habitacion = $_POST['habitacion'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];
        $estado = $_POST['estado'];

        // Depuración
        error_log("Datos recibidos: cliente=$cliente, habitacion=$habitacion, fechaInicio=$fechaInicio, fechaFin=$fechaFin, estado=$estado");

        // Verificar que la habitación esté disponible
        $sql = "SELECT * FROM habitaciones WHERE numero = :habitacion AND estado = 'disponible'";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':habitacion', $habitacion);
        $statement->execute();
        $habitacionDisponible = $statement->fetch(PDO::FETCH_ASSOC);

        if ($habitacionDisponible) {
            // Crear la reserva
            $sql = "INSERT INTO reservas (clienteNombre, habitacion, fechaInicio, fechaFin, estado) VALUES (:cliente, :habitacion, :fechaInicio, :fechaFin, :estado)";
            $statement = $dbh->prepare($sql);
            $statement->bindParam(':cliente', $cliente);
            $statement->bindParam(':habitacion', $habitacion);
            $statement->bindParam(':fechaInicio', $fechaInicio);
            $statement->bindParam(':fechaFin', $fechaFin);
            $statement->bindParam(':estado', $estado);
            $statement->execute();

            // Actualizar el estado de la habitación a 'ocupada'
            $sql = "UPDATE habitaciones SET estado = 'ocupada' WHERE numero = :habitacion";
            $statement = $dbh->prepare($sql);
            $statement->bindParam(':habitacion', $habitacion);
            $statement->execute();

            // Redirigir con un mensaje de éxito
            header("Location: ../frontend/crear_reserva.html?success=1");
        } else {
            // Redirigir con un mensaje de error si la habitación no está disponible
            header("Location: ../frontend/crear_reserva.html?error=1");
        }
    }
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
}
?>
