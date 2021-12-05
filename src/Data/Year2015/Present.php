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
     * @param int $length
     * @param int $width
     * @param int $height
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

    #[Pure] public function getSides(): array
    {
        return [
            $this->getLength() * $this->getWidth(),
            $this->getWidth() * $this->getHeight(),
            $this->getHeight() * $this->getLength()
        ];
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    public function getSmallestSide(): int
    {
        return min($this->getSides());
    }
}