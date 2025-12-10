<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2016;

use Knevelina\AdventOfCode\Puzzles\Year2016\Day05;
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
            [1, 1, '18f47a30'],
            [1, 2, '05ace8e3'],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): string
    {
        return 'f97c354d';
    }

    #[Override]
    public function getSolutionForPart2(): string
    {
        return '863dde27';
    }
}
