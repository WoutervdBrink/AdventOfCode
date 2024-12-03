<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day03 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        preg_match_all('/mul\\((\d{1,3}),(\d{1,3})\\)/', $input, $matches, PREG_SET_ORDER);
        return array_reduce(
            $matches,
            fn(int $carry, array $match): int => $carry + (int)$match[1] * (int)$match[2],
            0
        );
    }

    public function part2(string $input): int
    {
        preg_match_all('/(mul)\\((\d{1,3}),(\d{1,3})\\)|(do)\\(\\)|(don\'t)\\(\\)/', $input, $matches, PREG_SET_ORDER);

        $doing = true;
        $sum = 0;

        foreach ($matches as $match) {
            switch ($match[0]) {
                case 'do()':
                    $doing = true;
                    break;
                case 'don\'t()':
                    $doing = false;
                    break;
                default:
                    if ($doing) {
                        $sum += (int)$match[2] * (int)$match[3];
                    }
            }
        }

        return $sum;
    }
}