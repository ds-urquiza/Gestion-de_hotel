<?php
try {
    // Conexión a la base de datos SQLite
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procesar filtros
    $filtros = [];
    if (isset($_GET['estado']) && !empty($_GET['estado'])) {
        $filtros[] = "estado = '" . $_GET['estado'] . "'";
    }
    if (isset($_GET['cliente']) && !empty($_GET['cliente'])) {
        $filtros[] = "clienteNombre LIKE '%" . $_GET['cliente'] . "%'";
    }
    if (isset($_GET['fechaInicio']) && !empty($_GET['fechaInicio'])) {
        $filtros[] = "fechaInicio >= '" . $_GET['fechaInicio'] . "'";
    }
    if (isset($_GET['fechaFin']) && !empty($_GET['fechaFin'])) {
        $filtros[] = "fechaFin <= '" . $_GET['fechaFin'] . "'";
    }

    $where = '';
    if (count($filtros) > 0) {
        $where = 'WHERE ' . implode(' AND ', $filtros);
    }

    // Consultar las reservas con filtros
    $sql = "SELECT * FROM reservas $where";
    $statement = $dbh->prepare($sql);
    $statement->execute();
    $reservas = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['reservas' => $reservas]);
} catch (Exception $e) {
    // Devolver el error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>

