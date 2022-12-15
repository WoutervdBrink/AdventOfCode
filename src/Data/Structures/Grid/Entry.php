<?php

namespace Knevelina\AdventOfCode\Data\Structures\Grid;

class Entry
{
    public function __construct(
        private readonly Grid $grid,
        private readonly int $x,
        private readonly int $y,
        private mixed $value
    ) {
    }

    /**
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return $this->grid;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }

    /**
     * @param bool $includeDiagonals
     * @return array<Entry>
     */
    public function getNeighbors(bool $includeDiagonals = true): array
    {
        return $this->grid->getNeighbors($this->x, $this->y, $includeDiagonals);
    }
}