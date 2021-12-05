<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day12 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $json = json_decode($input);

        return self::sumJSON($json, false);
    }

    private static function sumJSON(mixed $json, bool $ignoreRed): int
    {
        $total = 0;

        foreach ($json as $part) {
            if ($ignoreRed && $part == 'red' && is_object($json)) {
                return 0;
            }

            if (is_array($part) || is_object($part)) {
                $total += self::sumJSON($part, $ignoreRed);
            }

            if (is_numeric($part)) {
                $total += $part;
            }
        }

        return $total;
    }

    public function part2(string $input): int
    {
        $json = json_decode($input);

        return self::sumJSON($json, true);
    }
}