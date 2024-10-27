<?php
try {
    // Conexión a la base de datos SQLite
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];

        $sql = "DELETE FROM clientes WHERE id = :id";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();

        header("Location: ../frontend/clientes.html");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
