<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\XMAS;
use Knevelina\AdventOfCode\InputManipulator;

class Day09 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $input = InputManipulator::getListOfIntegers($input);

        $xmas = new XMAS(25);

        $num = 0;

        foreach ($input as $num) {
            if (!$xmas->push($num)) {
                break;
            }
        }

        return $num;
    }

    public function part2(string $input): int
    {
        $invalid = $this->part1($input);

        $input = InputManipulator::getListOfIntegers($input);

        $sums = [];
        $sum = 0;

        foreach ($input as $x) {
            $sum += $x;
            $sums[] = $sum;
        }

        for ($x = 1; $x < count($input); $x++) {
            for ($y = $x + 1; $y < count($input); $y++) {
                $sum = $sums[$y] - $sums[$x - 1];

                if ($sum === $invalid) {
                    $values = array_slice($input, $x, $y - $x);

                    $low = min(...$values);
                    $high = max(...$values);

                    return $low + $high;
                }
            }
        }

        return 0;
    }
}