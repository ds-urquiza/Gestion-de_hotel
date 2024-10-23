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

    #[ORM\Column(type: 'string', length: 255)]
    private $tipoHabitacion; // Nuevo atributo para el tipo de habitación

    #[ORM\Column(type: 'float')]
    private $precio;

    // Getters y Setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoHabitacion(): string
    {
        return $this->tipoHabitacion;
    }

    public function setTipoHabitacion(string $tipoHabitacion): self
    {
        $this->tipoHabitacion = $tipoHabitacion;
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

