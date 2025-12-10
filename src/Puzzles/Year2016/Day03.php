<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day03 implements PuzzleSolver
{
    private static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): array {
            $sides = [];

            $line = preg_split('/ +/', $line);

            foreach ($line as $side) {
                $side = intval($side);

                if ($side > 0) {
                    $sides[] = $side;
                }
            }

            return $sides;
        });
    }

    private static function isValidTriangle(array $triangle): bool
    {
        sort($triangle);

        return $triangle[2] < $triangle[0] + $triangle[1];
    }

    #[Override]
    public function part1(string $input): int
    {
        return array_reduce(
            self::parseInput($input),
            fn (int $total, array $triangle) => $total + (self::isValidTriangle($triangle) ? 1 : 0),
            0
        );
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = self::parseInput($input);

        $triangles = [];

        for ($i = 0; $i < count($input) / 3; $i++) {
            $offset = $i * 3;
            for ($c = 0; $c < 3; $c++) {
                $triangles[] = [$input[$offset][$c], $input[$offset + 1][$c], $input[$offset + 2][$c]];
            }
        }

        return array_reduce(
            $triangles,
            fn (int $total, array $triangle) => $total + (self::isValidTriangle($triangle) ? 1 : 0),
            0
        );
    }
}
