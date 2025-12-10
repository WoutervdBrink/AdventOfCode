<?php

namespace Knevelina\AdventOfCode\Data\Year2015;

use JetBrains\PhpStorm\Pure;

class AdvancedLightGrid extends LightGrid
{
    private array $lights;

    public function __construct()
    {
        parent::__construct();

        for ($row = 0; $row < self::HEIGHT; $row++) {
            $this->lights[$row] = [];
            for ($col = 0; $col < self::WIDTH; $col++) {
                $this->lights[$row][$col] = 0;
            }
        }
    }

    public function turnOn(int $fromRow, int $fromCol, int $toRow, int $toCol): void
    {
        $this->apply($fromRow, $fromCol, $toRow, $toCol, fn (int $old): int => $old + 1);
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
        $this->apply($fromRow, $fromCol, $toRow, $toCol, fn (int $old): int => $old + 2);
    }

    public function turnOff($fromRow, $fromCol, $toRow, $toCol): void
    {
        $this->apply($fromRow, $fromCol, $toRow, $toCol, fn (int $old): int => max(0, $old - 1));
    }

    #[Pure]
    public function getBrightness(): int
    {
        $sum = 0;

        for ($row = 0; $row < self::HEIGHT; $row++) {
            $sum += array_sum($this->lights[$row]);
        }

        return intval($sum);
    }
}
