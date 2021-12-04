<?php

namespace Knevelina\AdventOfCode\Data\Year2021;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class Bingo
{
    const WIDTH = 5;
    const HEIGHT = 5;

    private array $values;
    private array $marked;

    public function __construct(array $values)
    {
        if (count($values) !== static::WIDTH * static::HEIGHT) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid amount of bingo values %d; should be %d',
                    count($values),
                    static::WIDTH * static::HEIGHT
                )
            );
        }

        $this->values = array_values($values);
        $this->marked = array_fill(0, self::WIDTH * self::HEIGHT, false);
    }

    public function mark(int $value): void
    {
        for ($x = 0; $x < self::WIDTH; $x++) {
            for ($y = 0; $y < self::HEIGHT; $y++) {
                if ($this->getValue($x, $y) === $value) {
                    $this->marked[self::encodeCoordinate($x, $y)] = true;
                }
            }
        }
    }

    #[Pure] public function getValue(int $x, int $y): int
    {
        return $this->values[self::encodeCoordinate($x, $y)];
    }

    #[Pure] public static function encodeCoordinate(int $x, int $y): int
    {
        return $y * self::WIDTH + $x;
    }

    #[Pure] public function hasBingo(): bool
    {
        for ($x = 0; $x < static::WIDTH; $x++) {
            $won = true;
            for ($y = 0; $y < static::HEIGHT; $y++) {
                if (!$this->isMarked($x, $y)) {
                    $won = false;
                    break;
                }
            }
            if ($won) {
                return true;
            }
        }

        for ($y = 0; $y < static::HEIGHT; $y++) {
            $won = true;
            for ($x = 0; $x < static::WIDTH; $x++) {
                if (!$this->isMarked($x, $y)) {
                    $won = false;
                    break;
                }
            }
            if ($won) {
                return true;
            }
        }

        return false;
    }

    #[Pure] public function isMarked(int $x, int $y): bool
    {
        return $this->marked[self::encodeCoordinate($x, $y)];
    }

    public function getMarkedNumbers(): array
    {
        return array_filter($this->values, fn(int $index): bool => $this->marked[$index], ARRAY_FILTER_USE_KEY);
    }

    public function getUnmarkedNumbers(): array
    {
        return array_filter($this->values, fn(int $index): bool => !$this->marked[$index], ARRAY_FILTER_USE_KEY);
    }

    #[Pure] public function __toString(): string
    {
        $str = '';

        for ($y = 0; $y < self::HEIGHT; $y++) {
            for ($x = 0; $x < self::WIDTH; $x++) {
                $str .= sprintf($this->isMarked($x, $y) ? '[%2d] ' : ' %2d  ', $this->getValue($x, $y));
            }
            $str .= PHP_EOL;
        }

        return $str;
    }
}