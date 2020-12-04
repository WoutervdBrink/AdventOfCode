<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day02Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 2],
            [1, 2, 1]
        ];
    }

    public function getSolutionForPart1()
    {
        return 586;
    }

    public function getSolutionForPart2()
    {
        return 352;
    }
}