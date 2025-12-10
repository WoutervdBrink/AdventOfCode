<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day02;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day02::class)]
class Day02Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 58],
            [2, 1, 43],

            [1, 2, 34],
            [2, 2, 14],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1606483;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 3842356;
    }
}
