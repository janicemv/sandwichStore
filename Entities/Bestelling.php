<?php
//Entities/Bestelling.php

declare(strict_types=1);

namespace Entities;


class Bestelling
{
    private int $id;
    private int $userID;
    private ?string $date;
    private ?int $statusID;
    private ?array $bestellijnen = [];
    private float $totaal = 0;


    public function __construct(int $userID, ?string $date, ?int $statusID)
    {
        $this->userID       = $userID;
        $this->date         = $date;
        $this->statusID     = $statusID;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserID(): int
    {
        return $this->userID;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function getStatusID(): ?int
    {
        return $this->statusID;
    }

    public function getBestellijnen(): ?array
    {
        return $this->bestellijnen;
    }

    public function addBestellijn(Bestellijn $bestellijn): void
    {
        $this->bestellijnen[] = $bestellijn;
        $this->calculateTotalPrice();
    }

    private function calculateTotalPrice()
    {
        $total = 0;

        if (is_array($this->bestellijnen)) {
            foreach ($this->bestellijnen as $bestellijn) {
                $total += $bestellijn->getTotalPrijs();
            }
        }

        $this->totaal = $total;
    }

    public function getTotaal(): float|int
    {
        return $this->totaal;
    }
}
