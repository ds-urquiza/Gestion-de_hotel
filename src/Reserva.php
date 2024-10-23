<?php
namespace Gestionhotel\Reservas;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'reservas')]
class Reserva extends RegistroHotel 
{
    #[ORM\Column(type: 'datetime')]
    private $fechaInicio;

    #[ORM\Column(type: 'datetime')]
    private $fechaFin;

    #[ORM\ManyToOne(targetEntity: "Cliente")]
    #[ORM\JoinColumn(nullable: false)]
    private $cliente;

    #[ORM\ManyToOne(targetEntity: "Habitacion")]
    #[ORM\JoinColumn(nullable: false)]
    private $habitacion;

    public function getFechaInicio(): \DateTime
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTime $fechaInicio): void
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaFin(): \DateTime
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTime $fechaFin): void
    {
        $this->fechaFin = $fechaFin;
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente): void
    {
        $this->cliente = $cliente;
    }

    public function getHabitacion(): Habitacion
    {
        return $this->habitacion;
    }

    public function setHabitacion(Habitacion $habitacion): void
    {
        $this->habitacion = $habitacion;
    }
}

