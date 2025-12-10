<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day08;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day08::class)]
class Day08Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 6],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 119;
    }

    #[Override]
    public function getSolutionForPart2(): string
    {
        return 'ZFHFSFOGPO';
    }
}
