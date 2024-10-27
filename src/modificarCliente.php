<?php
try {
    // Conexión a la base de datos SQLite
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $sql = "UPDATE clientes SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':email', $email);
        $statement->execute();

        header("Location: ../frontend/clientes.html");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
