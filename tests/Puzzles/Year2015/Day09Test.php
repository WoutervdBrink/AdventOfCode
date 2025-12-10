<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day09;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day09::class)]
class Day09Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 605],
            [1, 2, 982],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 141;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 736;
    }
}
