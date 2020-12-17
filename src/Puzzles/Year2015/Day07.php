<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2015\WireCollection;
use Knevelina\AdventOfCode\Data\Year2015\WireOperator;

class Day07 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $wc = new WireCollection($input);

        return $wc->getValue('a');
    }

    public function part2(string $input): int
    {
        $wc = new WireCollection($input);

        $wc->removeWire('b');
        $wc->addWire('b', WireOperator::VALUE, $this->part1($input));

        return $wc->getValue('a');
    }
}