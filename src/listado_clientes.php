<?php
try {
    // Conexión a la base de datos SQLite
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procesar filtros
    $filtros = [];
    if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
        $filtros[] = "nombre LIKE '%" . $_GET['nombre'] . "%'";
    }

    $where = '';
    if (count($filtros) > 0) {
        $where = 'WHERE ' . implode(' AND ', $filtros);
    }

    // Consultar los clientes con filtros
    $sql = "SELECT * FROM clientes $where";
    $statement = $dbh->prepare($sql);
    $statement->execute();
    $clientes = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['clientes' => $clientes]);
} catch (Exception $e) {
    // Devolver el error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>

