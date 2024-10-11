<?php
//Entities/Extra.php

declare(strict_types=1);

namespace Entities;

class Extra
{
    private int $id;
    private string $naam;
    private float $prijs;

    public function __construct(int $id, string $naam, float $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
    }

    public function getExtraId(): int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getPrijs(): float
    {
        return $this->prijs;
    }
}
