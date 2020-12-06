<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day06Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 11],
            [1, 2, 6]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 6161;
    }

    public function getSolutionForPart2(): int|null
    {
        return 2971;
    }
}