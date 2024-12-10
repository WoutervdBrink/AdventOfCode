<?php

namespace Knevelina\AdventOfCode\Data\Structures;

use Ds\Hashable;
use JetBrains\PhpStorm\Pure;

/**
 * Point helper class; provides several support function for polar coordinates.
 */
class Point implements Hashable
{
    public function __construct(private int $x, private int $y)
    {
    }

    /**
     * @param bool $includeDiagonal
     * @return Point[]
     */
    #[Pure] public function getNeighbors(bool $includeDiagonal = true): array
    {
        $neighbors = [
            new Point($this->x - 1, $this->y),
            new Point($this->x + 1, $this->y),
            new Point($this->x, $this->y - 1),
            new Point($this->x, $this->y + 1)
        ];

        if ($includeDiagonal) {
            $neighbors = [
                ...$neighbors,
                new Point($this->x - 1, $this->y - 1),
                new Point($this->x + 1, $this->y - 1),
                new Point($this->x - 1, $this->y + 1),
                new Point($this->x + 1, $this->y + 1),
            ];
        }

        return $neighbors;
    }

    /**
     * @param Point $other
     * @return bool
     */
    #[Pure] public function is(Point $other): bool
    {
        return $this->getX() === $other->getX() && $this->getY() === $other->getY();
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
     * @return string
     */
    #[Pure] public function hash(): string
    {
        return sprintf('%d_%d', $this->getX(), $this->getY());
    }

    public function equals(mixed $obj): bool
    {
        return $obj instanceof Point && $this->is($obj);
    }
}