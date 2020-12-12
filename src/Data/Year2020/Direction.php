<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class Direction
{
    const NORTH = 0;
    const EAST = 1;
    const SOUTH = 2;
    const WEST = 3;

    private int $direction;

    public function getDirection(): int
    {
        return $this->direction;
    }

    public function __construct(int $direction)
    {
        $this->direction = $direction;
    }

    #[Pure] public static function getDirectionForMnemonic(string $mnemonic): int
    {
        return match ($mnemonic) {
            'N' => self::NORTH,
            'S' => self::SOUTH,
            'E' => self::EAST,
            'W' => self::WEST,
            default => -1
        };
    }

    #[Pure] public static function getHorizontalMovementForDirection(int $direction, int $distance): int
    {
        return match ($direction) {
            self::EAST => $distance,
            self::WEST => -$distance,
            default => 0
        };
    }

    #[Pure] public static function getVerticalMovementForDirection(int $direction, int $distance): int
    {
        return match ($direction) {
            self::NORTH => -$distance,
            self::SOUTH => $distance,
            default => 0
        };
    }

    #[Pure] public function getHorizontalMovement(int $distance): int
    {
        return self::getHorizontalMovementForDirection($this->direction, $distance);
    }

    #[Pure] public function getVerticalMovement(int $distance): int
    {
        return self::getVerticalMovementForDirection($this->direction, $distance);
    }

    public function turn(int $degrees): void
    {
        if (($degrees % 90) !== 0) {
            throw new InvalidArgumentException(
                sprintf('Trying to turn the ship by %d degrees is not allowed.', $degrees)
            );
        }

        $this->direction = ($this->direction + ($degrees / 90)) % 4;

        while ($this->direction < 0) {
            $this->direction += 4;
        }
    }
}