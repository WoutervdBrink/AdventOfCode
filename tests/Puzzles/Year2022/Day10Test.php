<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2022;

use Knevelina\AdventOfCode\Puzzles\Year2022\Day10;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Day10::class)]
class Day10Test extends PuzzleSolverTestCase
{
    public static function getExamples(): array
    {
        return [
            [1, 1, 13140],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 15220;
    }

    #[Override]
    public function getSolutionForPart2(): string
    {
        return 'RFZEKBFA';
    }
}
