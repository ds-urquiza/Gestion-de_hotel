<?php
try {
    // Conexión a la base de datos SQLite
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertar nuevo cliente
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        // Depuración
        error_log("Datos recibidos: nombre=$nombre, telefono=$telefono, email=$email");

        $sql = "INSERT INTO clientes (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':email', $email);
        $statement->execute();

        // Depuración
        error_log("Cliente registrado con éxito");

        header("Location: ../frontend/registrar-cliente.html?success=1");
    }
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo "Error: " . $e->getMessage();
}
?>


