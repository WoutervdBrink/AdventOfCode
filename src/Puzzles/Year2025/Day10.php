<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2025\Day10\Machine;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day10 implements PuzzleSolver
{
    /**
     * @return Machine[]
     */
    private static function parse(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: Machine::fromSpecification(...));
    }

    #[Override]
    public function part1(string $input): int
    {
        $machines = self::parse($input);
        $solution = 0;

        foreach ($machines as $machine) {
            $solution += $machine->getFewestButtonPresses();
        }

        return $solution;
    }

    #[Override]
    public function part2(string $input): int
    {
        $machines = self::parse($input);
        $solution = 0;

        foreach ($machines as $machine) {
            $solution += $machine->getFewestJoltageButtons();
        }

        return $solution;
    }
}
