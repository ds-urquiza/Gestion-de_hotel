<?php

// Conexión a la base de datos SQLite
$dsn = 'sqlite:../db/database.sqlite';
$dbh = new PDO($dsn);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


/* crear una nueva habitacion */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar datos desde el formulario
    $tipoHabitacion = $_POST['tipo_habitacion'];
    $precio = floatval($_POST['precio']);

    // Crear una nueva instancia de Habitacion
    $habitacion = new Habitacion();
    $habitacion->setTipoHabitacion($tipoHabitacion);
    $habitacion->setPrecio($precio);

    // Guardar la habitación en la base de datos
    $entityManager->persist($habitacion);
    $entityManager->flush();

    echo "Habitación registrada exitosamente.";
} else {
    echo "Error de registro.";
}