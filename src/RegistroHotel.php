<?php
namespace Gestionhotel\Reservas;

class RegistroHotel
{
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
