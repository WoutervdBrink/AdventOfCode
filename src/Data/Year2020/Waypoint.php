<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use InvalidArgumentException;

class Waypoint
{
    private int $x;

    private int $y;

    public function __construct()
    {
        $this->x = 10;
        $this->y = -1;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function move(int $direction, int $distance): void
    {
        $this->x += Direction::getHorizontalMovementForDirection($direction, $distance);
        $this->y += Direction::getVerticalMovementForDirection($direction, $distance);
    }

    public function rotateRight(int $degrees): void
    {
        if (($degrees % 90) !== 0) {
            throw new InvalidArgumentException(
                sprintf('Trying to turn the ship by %d degrees is not allowed.', $degrees)
            );
        }

        $x = $this->x;
        $y = $this->y;

        switch ($degrees) {
            case 90:
                $this->x = -$y;
                $this->y = $x;
                break;
            case 180:
                $this->x = -$x;
                $this->y = -$y;
                break;
            case 270:
                $this->x = $y;
                $this->y = -$x;
                break;
        }
    }

    public function rotateLeft(int $degrees): void
    {
        if (($degrees % 90) !== 0) {
            throw new InvalidArgumentException(
                sprintf('Trying to turn the ship by %d degrees is not allowed.', $degrees)
            );
        }

        $x = $this->x;
        $y = $this->y;

        switch ($degrees) {
            case 90:
                $this->x = $y;
                $this->y = -$x;
                break;
            case 180:
                $this->x = -$x;
                $this->y = -$y;
                break;
            case 270:
                $this->x = -$y;
                $this->y = $x;
                break;
        }
    }
}
