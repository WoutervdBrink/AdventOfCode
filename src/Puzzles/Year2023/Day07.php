<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2023\Day07\Hand;
use Knevelina\AdventOfCode\Data\Year2023\Day07\JokerHand;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day07 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $hands = InputManipulator::splitLines($input, manipulator: Hand::fromDescription(...));

        usort($hands, Hand::compare(...));

        $winnings = 0;

        foreach ($hands as $rank => $hand) {
            $winnings += ($rank + 1) * $hand->bid;
        }

        return $winnings;
    }

    #[Override]
    public function part2(string $input): int
    {
        $hands = InputManipulator::splitLines($input, manipulator: JokerHand::fromDescription(...));

        usort($hands, JokerHand::compare(...));

        $winnings = 0;

        foreach ($hands as $rank => $hand) {
            $winnings += ($rank + 1) * $hand->bid;
        }

        return $winnings;
    }
}
