<?php
namespace Gestionhotel\Reservas;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'habitaciones')]
class Habitacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $numero;

    #[ORM\Column(type: 'decimal',precision:10, scale: 2)]
    private $precio;

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;
        return $this;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;
        return $this;
    }
}

