<?php
namespace Gestionhotel\Reservas;

use Doctrine\ORM\Mapping as ORM;

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
}
?>


  

    


    

  


