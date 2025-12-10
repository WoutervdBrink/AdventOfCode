<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day04 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): float
    {
        $score = 0;

        foreach (self::parse($input) as $card) {
            if ($card > 0) {
                $score += pow(2, $card - 1);
            }
        }

        return $score;
    }

    /**
     * @return array<int>
     */
    private static function parse(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): int {
            preg_match_all('/(\d+)/', $line, $matches);

            array_shift($matches[1]);

            $seen = [];
            $score = 0;

            foreach ($matches[1] as $match) {
                if (isset($seen[$match])) {
                    $score++;
                }

                $seen[$match] = true;
            }

            return $score;
        });
    }

    #[Override]
    public function part2(string $input): int
    {
        $cards = self::parse($input);
        $copies = array_fill(0, count($cards), 1);

        /**
         * @var int $id
         * @var int $card
         */
        foreach ($cards as $id => $card) {
            for ($i = 0; $i < $card; $i++) {
                $copyId = $id + $i + 1;

                if ($copyId >= count($cards)) {
                    break;
                }

                $copies[$copyId] += $copies[$id];
            }
        }

        return array_sum($copies);
    }
}
