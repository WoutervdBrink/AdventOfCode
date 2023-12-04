<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day03;

final class Gear
{
    /** @var array<Part> */
    private array $parts;

    public function __construct(public readonly int $x, public readonly int $y)
    {
        $this->parts = [];
    }

    public function addPart(Part $part): void
    {
        $this->parts[] = $part;
    }

    public function getRatio(): int
    {
        if (count($this->parts) !== 2) {
            return 0;
        }

        return $this->parts[0]->partNumber * $this->parts[1]->partNumber;
    }
}