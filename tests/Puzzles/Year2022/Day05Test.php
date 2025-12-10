<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day05;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day05::class)]
class Day05Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 'CMZ'],
            [1, 2, 'MCD'],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): string
    {
        return 'CWMTGHBDW';
    }

    #[Override]
    public function getSolutionForPart2(): string
    {
        return 'SSCGWJCRB';
    }
}
