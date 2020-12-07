<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2015\Present;
use Knevelina\AdventOfCode\InputManipulator;

class Day02 implements PuzzleSolver
{

    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input);

        $total = 0;

        foreach ($input as $measurements) {
            $measurements = explode('x', $measurements, 3);

            $present = new Present($measurements[0], $measurements[1], $measurements[2]);

            $total += $present->getArea();
            $total += $present->getSmallestSide();
        }

        return $total;
    }

    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input);

        $total = 0;

        foreach ($input as $measurements) {
            $measurements = explode('x', $measurements, 3);

            $measurements = array_map(fn ($ms) => intval($ms), $measurements);

            $present = new Present($measurements[0], $measurements[1], $measurements[2]);

            // wrap
            sort($measurements);
            $total += $measurements[0] + $measurements[0] + $measurements[1] + $measurements[1];

            // bow
            $total += $present->getWidth() * $present->getHeight() * $present->getLength();
        }

        return $total;
    }
}