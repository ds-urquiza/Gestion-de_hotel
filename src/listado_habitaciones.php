
<?php
try {
    // Conexión a la base de datos SQLite
    $dsn = 'sqlite:../db/database.sqlite';
    $dbh = new PDO($dsn);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procesar filtros
    $filtros = [];
    if (isset($_GET['tipo']) && !empty($_GET['tipo'])) {
        $filtros[] = "tipo = '" . $_GET['tipo'] . "'";
    }
    if (isset($_GET['estado']) && !empty($_GET['estado'])) {
        $filtros[] = "estado = '" . $_GET['estado'] . "'";
    }

    $where = '';
    if (count($filtros) > 0) {
        $where = 'WHERE ' . implode(' AND ', $filtros);
    }

    // Consultar las habitaciones con filtros
    $sql = "SELECT * FROM habitaciones $where";
    $statement = $dbh->prepare($sql);
    $statement->execute();
    $habitaciones = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['habitaciones' => $habitaciones]);
} catch (Exception $e) {
    // Devolver el error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
