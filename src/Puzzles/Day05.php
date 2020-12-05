<?php


namespace Knevelina\AdventOfCode\Puzzles;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Seat;
use Knevelina\AdventOfCode\InputManipulator;

class Day05 implements PuzzleSolver
{

    public function part1(string $input)
    {
        $seats = InputManipulator::splitLines($input);
        $maxId = 0;

        foreach ($seats as $seat) {
            $maxId = max($maxId, Seat::fromSpecification($seat)->getId());
        }

        return $maxId;
    }

    public function part2(string $input)
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
    }
}