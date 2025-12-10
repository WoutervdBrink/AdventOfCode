<?php

namespace Knevelina\AdventOfCode\Data\Year2015;

use JetBrains\PhpStorm\Pure;

class Present
{
    private int $length;

    private int $width;

    private int $height;

    /**
     * Present constructor.
     */
    public function __construct(int $length, int $width, int $height)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }

    public function getArea(): int
    {
        return intval(2 * array_sum($this->getSides()));
    }

    #[Pure]
    public function getSides(): array
    {
        return [
            $this->getLength() * $this->getWidth(),
            $this->getWidth() * $this->getHeight(),
            $this->getHeight() * $this->getLength(),
        ];
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getSmallestSide(): int
    {
        return min($this->getSides());
    }
}
