<?php
try {
    
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if (isset($_GET['nombre'])) {
        $nombre_cliente = $_GET['nombre'];

    
        $sql = "SELECT id, fechaInicio, fechaFin, estado, habitacion
                FROM reservas
                WHERE clienteNombre = :nombre_cliente";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':nombre_cliente', $nombre_cliente);
        $statement->execute();
        $reservas = $statement->fetchAll(PDO::FETCH_ASSOC);

        
        header('Content-Type: application/json');
        echo json_encode($reservas);
    } else {
    
        echo json_encode(['error' => 'Nombre del cliente no proporcionado']);
    }
} catch (Exception $e) {

    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
