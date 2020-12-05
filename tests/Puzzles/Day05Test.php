<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day05Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 368]
        ];ś
    }

    public function getSolutionForPart1()
    {
        return 878;
    }

    public function getSolutionForPart2()
    {
        return 504;
    }
}