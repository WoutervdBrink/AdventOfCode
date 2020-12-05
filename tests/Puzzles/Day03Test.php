<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day03Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 7],
            [1, 2, 336]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 164;
    }

    public function getSolutionForPart2(): int
    {
        return 5007658656;
    }
}