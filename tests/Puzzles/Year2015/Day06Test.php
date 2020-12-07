<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day06Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 4],
            [2, 2, 2000000]
        ];
    }

    public function getSolutionForPart1(): int
    {
        return 400410;
    }
}