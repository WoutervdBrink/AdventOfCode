<?php


namespace Knevelina\AdventOfCode\Puzzles;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

/**
 * Day 1: Report Repair
 * @package Knevelina\AdventOfCode\Puzzles
 */
class Day01 implements PuzzleSolver
{
    public function part1(string $input)
    {
        $values = InputManipulator::getListOfIntegers($input);

        $mem = [];

        foreach ($values as $value) {
            $opposite = 2020 - $value;

            if (isset($mem[$opposite])) {
                return $opposite * $value;
            }

            $mem[$value] = true;
        }

        return 0;
    }

    public function part2(string $input)
    {
        $values = InputManipulator::getListOfIntegers($input);

        sort($values);

        $mem = [];

        foreach ($values as $value) {
            $mem[$value] = 1;
        }

        for ($i = 0; $i < count($values); $i++) {
            $a = $values[$i];
            $b_c = 2020 - $a;

            for ($j = $i + 1; $j < count($values); $j++) {
                $b = $values[$j];
                if ($b >= $b_c) {
                    break;
                }

                $c = 2020 - ($a + $b);

                if (isset($mem[$c])) {
                    return $a * $b * $c;
                }
            }
        }

        return 0;
    }
}