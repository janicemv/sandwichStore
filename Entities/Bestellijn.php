<?php
//Entities/Bestellijn.php

namespace Entities;

class Bestellijn
{
    private Brood $brood;
    private ?array $extras = null;
    private float $totalPrijs = 0;

    public function __construct(Brood $brood)
    {
        $this->brood = $brood;
        $this->calculatePrice();
    }

    public function getBrood(): Brood
    {
        return $this->brood;
    }

    public function getExtras(): ?array
    {
        return $this->extras;
    }

    public function addExtra(Extra $extra): void
    {
        $this->extras[] = $extra;
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $total = 0;
        $total += $this->brood->getPrijs();

        if (is_array($this->extras)) {
            foreach ($this->extras as $extra) {
                $total += $extra->getPrijs();
            }
        }

        $this->totalPrijs = $total;
    }

    public function getTotalPrijs(): float|int
    {
        return $this->totalPrijs;
    }
}
