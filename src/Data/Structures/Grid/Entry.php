<?php

namespace Knevelina\AdventOfCode\Data\Structures\Grid;

use Knevelina\AdventOfCode\Data\Structures\Point;

class Entry
{
    public function __construct(
        private readonly Grid $grid,
        private readonly int $x,
        private readonly int $y,
        private mixed $value
    ) {}

    public function toPoint(): Point
    {
        return new Point($this->x, $this->y);
    }

    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * @return array<Entry>
     */
    public function getNeighbors(bool $includeDiagonals = true): array
    {
        return $this->grid->getNeighbors($this->x, $this->y, $includeDiagonals);
    }

    public function __toString(): string
    {
        return '['.$this->x.','.$this->y.' == '.$this->value.']';
    }
}
