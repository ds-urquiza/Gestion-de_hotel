<?php
namespace Gestionhotel\Reservas;

use Doctrine\ORM\Mapping as ORM;
use PDO;

#[ORM\Entity]
#[ORM\Table(name: 'clientes')]
class Cliente {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 20)]
    private $telefono;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $email;

    // Constructor
    public function __construct(string $nombre, string $telefono, string $email) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    // Getters y Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self {
        $this->nombre = $nombre;
        return $this;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    // Método para guardar en la base de datos
    public function guardar() {
        try {
            $pdo = new PDO('sqlite:db/database.sqlite');
            $stmt = $pdo->prepare("INSERT INTO clientes (nombre, telefono, email) VALUES (:nombre, :telefono, :email)");
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Método para actualizar en la base de datos
    public function actualizar($id) {
        try {
            $pdo = new PDO('sqlite:db/database.sqlite');
            $stmt = $pdo->prepare("UPDATE clientes SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':telefono', $this->telefono);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Método para eliminar en la base de datos
    public function eliminar($id) {
        try {
            $pdo = new \PDO('sqlite:db/database.sqlite');
            $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = :id"); 
            $stmt->bindParam(':id', $id);
             $stmt->execute();
             } catch (\PDOException $e) { 
                echo 'Error: ' . $e->getMessage(); 
            } 
        }
    }
    
?>


    

  


