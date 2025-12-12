<?php

namespace Knevelina\AdventOfCode\Data\Year2025\Day12;

use InvalidArgumentException;

readonly class Area
{
    public int $width;

    public int $height;

    public int $area;

    public array $requirements;

    public function __construct(string $line)
    {
        [$size, $presents] = explode(': ', $line, 2);

        if (! preg_match('/^(\d+)x(\d+)$/', $size, $matches)) {
            throw new InvalidArgumentException('Invalid area: size '.$size.' is invalid');
        }

        $this->width = intval($matches[1]);
        $this->height = intval($matches[2]);
        $this->area = $this->width * $this->height;

        $presents = explode(' ', $presents);
        $this->requirements = array_map('intval', $presents);
    }
}
