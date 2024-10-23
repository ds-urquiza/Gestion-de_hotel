<?php
namespace Gestionhotel\Reservas;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'habitaciones')]
class Habitacion extends RegistroHotel
{
    #[ORM\Column(type: 'integer')]
    private $numero;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $precio;

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

}

