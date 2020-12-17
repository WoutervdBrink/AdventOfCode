<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

class Ship
{
    private int $x;
    private int $y;
    private Direction $direction;

    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->direction = new Direction(Direction::EAST);
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): Ship
    {
        $this->x = $x;
        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): Ship
    {
        $this->y = $y;
        return $this;
    }

    public function getDirection(): int
    {
        return $this->direction->getDirection();
    }

    public function move(int $direction, int $distance): void
    {
        $this->x += Direction::getHorizontalMovementForDirection($direction, $distance);
        $this->y += Direction::getVerticalMovementForDirection($direction, $distance);
    }

    public function turnLeft(int $degrees): void
    {
        $this->direction->turn(-$degrees);
    }

    public function turnRight(int $degrees): void
    {
        $this->direction->turn($degrees);
    }
}