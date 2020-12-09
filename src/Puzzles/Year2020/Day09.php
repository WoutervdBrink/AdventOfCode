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

        for ($x = 0; $x < count($input); $x++) {
            for ($y = 0; $y < count($input); $y++) {
                if ($x === $y) {
                    continue;
                }

                $values = [];

                for ($i = $x; $i <= $y; $i++) {
                    $values[] = $input[$i];
                }

                $sum = array_sum($values);

                if ($sum === $invalid) {
                    $low = min(...$values);
                    $high = max(...$values);

                    return $low + $high;
                }
            }
        }

        return 0;
    }
}