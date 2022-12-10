<?php

namespace Knevelina\AdventOfCode\Data\Structures;

use InvalidArgumentException;

enum Direction: string
{
    case UP = 'U';
    case DOWN = 'D';
    case LEFT = 'L';
    case RIGHT = 'R';

    public static function fromLetter(string $letter): Direction
    {
        return match ($letter) {
            'U' => self::UP,
            'D' => self::DOWN,
            'L' => self::LEFT,
            'R' => self::RIGHT,
            default => throw new InvalidArgumentException(sprintf('Invalid directional letter "%s"', $letter))
        };
    }

    public function getHorizontalMovement(): int
    {
        return match ($this) {
            self::LEFT => -1,
            self::RIGHT => 1,
            default => 0
        };
    }

    public function getVerticalMovement(): int
    {
        return match ($this) {
            self::UP => -1,
            self::DOWN => 1,
            default => 0
        };
    }

    public function clockwise(): self
    {
        return match ($this) {
            self::UP => self::RIGHT,
            self::RIGHT => self::DOWN,
            self::DOWN => self::LEFT,
            self::LEFT => self::UP
        };
    }

    public function counterClockwise(): self
    {
        return match ($this) {
            self::UP => self::LEFT,
            self::LEFT => self::DOWN,
            self::DOWN => self::RIGHT,
            self::RIGHT => self::UP
        };
    }
}
