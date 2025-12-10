<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day13 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = explode("\n", $input, 2);
        $arrival = intval($input[0]);
        $ids = explode(',', $input[1]);
        $ids = array_map(fn (string $id): int => intval($id), $ids);
        $ids = array_filter($ids, fn (int $id): bool => $id > 0);

        $bestId = 0;
        $bestTs = PHP_INT_MAX;

        foreach ($ids as $id) {
            $next = $arrival - ($arrival % $id) + $id;
            if ($next < $bestTs) {
                $bestTs = $next;
                $bestId = $id;
            }
        }

        return ($bestTs - $arrival) * $bestId;
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = explode("\n", $input, 2);
        $ids = explode(',', $input[1]);
        $ids = array_map(fn (string $id): int => intval($id), $ids);

        $bus = [];
        $offset = [];

        $N = 1;

        foreach ($ids as $rem => $num) {
            if ($num === 0) {
                continue;
            }

            $bus[] = $num;
            $offset[] = $rem;

            $N *= $num;
        }

        $total = 0;

        for ($i = 0; $i < count($bus); $i++) {
            $b = $bus[$i] - $offset[$i];
            $n = $N / $bus[$i];
            $x = $this->calculateX((int) $n, $bus[$i]);

            $total += $b * $n * $x;
        }

        return $total % $N;
    }

    private function calculateX(int $multiplier, int $modulator): int
    {
        for ($x = 1; $x <= $multiplier; $x++) {
            if ((($x * $multiplier) % $modulator) === 1) {
                return $x;
            }
        }

        return 0;
    }
}
