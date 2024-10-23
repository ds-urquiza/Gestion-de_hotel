<?php
namespace Gestionhotel\Reservas;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'reservas')]
class Reserva {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $fechaInicio;

    #[ORM\Column(type: 'datetime')]
    private $fechaFin;

    #[ORM\ManyToOne(targetEntity: 'Habitacion')]
    #[ORM\JoinColumn(name: 'habitacion_id', referencedColumnName: 'id')]
    private $habitacion;

    #[ORM\Column(type: 'string', length: 100)]
    private $clienteNombre;

    // Constructor
    public function __construct(\DateTimeInterface $fechaInicio, \DateTimeInterface $fechaFin, Habitacion $habitacion, string $clienteNombre) {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->habitacion = $habitacion;
        $this->clienteNombre = $clienteNombre;
    }

    // Getters y Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function getFechaInicio(): \DateTimeInterface {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self {
        $this->fechaInicio = $fechaInicio;
        return $this;
    }

    public function getFechaFin(): \DateTimeInterface {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self {
        $this->fechaFin = $fechaFin;
        return $this;
    }

    public function getHabitacion(): ?Habitacion {
        return $this->habitacion;
    }

    public function setHabitacion(?Habitacion $habitacion): self {
        $this->habitacion = $habitacion;
        return $this;
    }

    public function getClienteNombre(): string {
        return $this->clienteNombre;
    }

    public function setClienteNombre(string $clienteNombre): self {
        $this->clienteNombre = $clienteNombre;
        return $this;
    }
}
?>


