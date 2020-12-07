<?php


namespace Knevelina\AdventOfCode\Tests\Puzzles;


use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

class Day07Test extends PuzzleSolverTestCase
{

    public function getExamples(): array
    {
        return [
            [1, 1, 4],
            [1, 2, 32],
            [2, 2, 126]
        ];
    }

    public function getSolutionForPart1(): int|null
    {
        return 211;
    }

    public function getSolutionForPart2(): int|null
    {
        return 12414;
    }
}