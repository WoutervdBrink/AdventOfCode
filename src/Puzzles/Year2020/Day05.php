<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\Seat;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day05 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $seats = InputManipulator::splitLines($input);
        $maxId = 0;

        foreach ($seats as $seat) {
            $maxId = max($maxId, Seat::fromSpecification($seat)->getId());
        }

        return $maxId;
    }

    #[Override]
    public function part2(string $input): int
    {
        $seats = InputManipulator::splitLines($input);
        $ids = array_map(fn ($spec) => Seat::fromSpecification($spec)->getId(), $seats);
        sort($ids);

        for ($i = 1; $i < count($ids); $i++) {
            if ($ids[$i] !== ($ids[$i - 1] + 1)) {
                // ids[i] is our high neighbour
                // ids[i - 1] is our low neighbor
                // so we must be ids[i] - 1.
                return $ids[$i] - 1;
            }
        }

        return 0;
    }
}
