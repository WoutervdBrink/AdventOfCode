<?php

namespace Knevelina\AdventOfCode\Data\Year2015;

class LightGrid
{
    const WIDTH = 1000;
    const HEIGHT = 1000;
    private array $lights;

    public function __construct()
    {
        for ($row = 0; $row < self::HEIGHT; $row++) {
            $this->lights[$row] = [];
            for ($col = 0; $col < self::WIDTH; $col++) {
                $this->lights[$row][$col] = false;
            }
        }
    }

    public function turnOn(int $fromRow, int $fromCol, int $toRow, int $toCol): void
    {
        $this->apply($fromRow, $fromCol, $toRow, $toCol, fn(bool $old): bool => true);
    }

    private function apply(int $fromRow, int $fromCol, int $toRow, int $toCol, callable $action): void
    {
        for ($row = $fromRow; $row <= $toRow; $row++) {
            for ($col = $fromCol; $col <= $toCol; $col++) {
                $this->lights[$row][$col] = $action($this->lights[$row][$col]);
            }
        }
    }

    public function toggle($fromRow, $fromCol, $toRow, $toCol): void
    {
        $this->apply($fromRow, $fromCol, $toRow, $toCol, fn(bool $old): bool => !$old);
    }

    public function turnOff($fromRow, $fromCol, $toRow, $toCol): void
    {
        $this->apply($fromRow, $fromCol, $toRow, $toCol, fn(bool $old): bool => false);
    }

    public function getEnabledLights(): int
    {
        $sum = 0;

        for ($row = 0; $row < self::HEIGHT; $row++) {
            for ($col = 0; $col < self::WIDTH; $col++) {
                if ($this->lights[$row][$col]) {
                    $sum++;
                }
            }
        }

        return $sum;
    }
}