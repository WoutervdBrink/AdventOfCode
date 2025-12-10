<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day10 implements PuzzleSolver
{
    private array $arrangements;

    private int $max;

    #[Override]
    public function part1(string $input): int
    {
        $input = InputManipulator::getListOfIntegers($input);

        sort($input);

        $c_1 = 0;
        $c_3 = 0;

        for ($i = 1; $i < count($input); $i++) {
            $diff = $input[$i] - $input[$i - 1];

            if ($diff === 1) {
                $c_1++;
            } else {
                $c_3++;
            }
        }

        return ($c_1 + 1) * ($c_3 + 1);
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = InputManipulator::getListOfIntegers($input);

        sort($input);

        $this->arrangements = [];

        $this->max = last($input);

        return $this->getArrangements($input, 0);
    }

    protected function getArrangements(array $input, int $adapter): int
    {
        if (! isset($this->arrangements[$adapter])) {
            if ($adapter === $this->max) {
                return $this->arrangements[$adapter] = 1;
            }

            $sum = 0;

            for ($i = 1; $i <= 3; $i++) {
                if (in_array($adapter + $i, $input)) {
                    $sum += $this->getArrangements($input, $adapter + $i);
                }
            }

            $this->arrangements[$adapter] = $sum;
        }

        return $this->arrangements[$adapter];
    }
}
