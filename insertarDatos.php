// insertarDatos.php
require_once "bootstrap.php";

$cliente = new Cliente();
$cliente->setNombre("Juan Pérez");
$cliente->setEmail("juan.perez@example.com");

$entityManager->persist($cliente);
$entityManager->flush();

echo "Cliente creado con ID " . $cliente->getId() . "\n";
