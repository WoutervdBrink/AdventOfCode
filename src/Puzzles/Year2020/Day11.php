<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\WaitingArea;
use Override;

class Day11 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $area = WaitingArea::fromSpecification($input);

        while (true) {
            $newArea = $area->step();

            if ($newArea === null) {
                break;
            }

            $area = $newArea;
        }

        return $area->getOccupiedSeats();
    }

    #[Override]
    public function part2(string $input): int
    {
        $area = WaitingArea::fromSpecification($input);

        while (true) {
            $newArea = $area->stepPart2();

            if ($newArea === null) {
                break;
            }

            $area = $newArea;
        }

        return $area->getOccupiedSeats();
    }
}
