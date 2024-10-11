<?php
//Entities/Brood.php

declare(strict_types=1);

namespace Entities;

class Brood
{
    private int $id;
    private string $naam;
    private string $omschrijving;
    private float $prijs;
    private ?Extra $extras;


    public function __construct(int $id, string $naam, string $omschrijving, float $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->omschrijving = $omschrijving;
        $this->prijs = $prijs;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getOmschrijving(): string
    {
        return $this->omschrijving;
    }

    public function getPrijs(): float
    {
        return $this->prijs;
    }

    public function getExtras(): ?Extra
    {
        return $this->extras;
    }

    public function setExtras(?Extra $extras): void
    {
        $this->extras = $extras;
    }
}
