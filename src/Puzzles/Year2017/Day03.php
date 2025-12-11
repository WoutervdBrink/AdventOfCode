<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2017;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day03 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $n = intval(trim($input));

        if ($n === 1) {
            return 0;
        }

        $i = 1;

        while ($i ** 2 < $n) {
            $i += 2;
        }

        $pivots = [];
        for ($k = 0; $k < 4; $k++) {
            $pivots[] = $i ** 2 - $k * ($i - 1);
        }

        foreach ($pivots as $p) {
            $distance = abs($p - $n);
            if ($distance <= floor(($i - 1) / 2)) {
                return $i - 1 - $distance;
            }
        }

        return 0;
    }

    #[Override]
    public function part2(string $input): int
    {
        $n = intval(trim($input));

        /** @var array<string, int> $grid */
        $grid = [];

        $encode = function (int $x, int $y) {
            return $x.'_'.$y;
        };

        $x = 0;
        $y = 0;

        $dx = 0;
        $dy = -1;

        while (true) {
            $val = 0;
            for ($oy = -1; $oy <= 1; $oy++) {
                for ($ox = -1; $ox <= 1; $ox++) {
                    if (isset($grid[$encode($x + $ox, $y + $oy)])) {
                        $val += $grid[$encode($x + $ox, $y + $oy)];
                    }
                }
            }

            if ($x === 0 && $y === 0) {
                $val = 1;
            }

            $grid[$encode($x, $y)] = $val;

            if ($val > $n) {
                return $val;
            }

            if (
                $x === $y ||
                ($x < 0 && $x === -$y) ||
                ($x > 0 && $x === 1 - $y)
            ) {
                $tmp = $dx;
                $dx = -$dy;
                $dy = $tmp;
            }

            $x += $dx;
            $y += $dy;
        }
    }
}
