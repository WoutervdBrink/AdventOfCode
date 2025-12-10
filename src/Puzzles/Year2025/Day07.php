<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Override;

class Day07 extends CombinedPuzzleSolver
{
    #[Override]
    protected function solve(string $input): CombinedPuzzleOutput
    {
        $grid = Grid::fromInput($input, 'strval');

        /** @var int[] $beams */
        $beams = array_fill(0, $grid->getWidth(), 0);

        $splits = 0;

        for ($x = 0; $x < $grid->getWidth(); $x++) {
            if ($grid->getValue($x, 0) === 'S') {
                $beams[$x] = 1;
            }
        }

        for ($y = 1; $y < $grid->getHeight(); $y++) {
            for ($x = 0; $x < $grid->getWidth(); $x++) {
                if ($grid->getValue($x, $y) === '^') {
                    $splits += (($beams[$x] > 0) ? 1 : 0);

                    $beams[$x - 1] += $beams[$x];
                    $beams[$x + 1] += $beams[$x];
                    $beams[$x] = 0;
                }
            }
        }

        return CombinedPuzzleOutput::of($splits, array_sum($beams));
    }
}
