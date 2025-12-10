<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day02;
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
            [1, 1, '1985'],
            [1, 2, '5DB3'],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): string
    {
        return '47978';
    }

    #[Override]
    public function getSolutionForPart2(): string
    {
        return '659AD';
    }
}
