<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Override;

class Day01 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = str_split(trim($input));
        sort($input);

        $floor = 0;

        while ($input[$floor] === '(') {
            $floor++;

            if ($floor >= count($input)) {
                break;
            }
        }

        $floor -= (count($input) - $floor);

        return $floor;
    }

    #[Override]
    public function part2(string $input): int
    {
        $floor = 0;

        for ($i = 0; $i < strlen($input); $i++) {
            $movement = substr($input, $i, 1);
            if ($movement === '(') {
                $floor++;
            }
            if ($movement === ')') {
                $floor--;
            }
            if ($floor === -1) {
                return $i + 1;
            }
        }

        return 0;
    }
}
