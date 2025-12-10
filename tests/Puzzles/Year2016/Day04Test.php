<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day04;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day04::class)]
class Day04Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 1514],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 185371;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 984;
    }
}
