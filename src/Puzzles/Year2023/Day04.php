<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2023\Day04\Card;
use Knevelina\AdventOfCode\InputManipulator;

class Day04 implements PuzzleSolver
{
    public function part1(string $input): float
    {
        return array_sum(array_map(fn(Card $card): float => $card->getScore(), self::parse($input)));
    }

    /**
     * @param string $input
     * @return array<Card>
     */
    private static function parse(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: fn(string $line): Card => Card::fromInput($line));
    }

    public function part2(string $input): int
    {
        $cards = self::parse($input);
        $copies = array_fill(0, count($cards), 1);

        /**
         * @var int $id
         * @var Card $card
         */
        foreach ($cards as $id => $card) {
            for ($i = 0; $i < $card->getMatches(); $i++) {
                $copyId = $id + $i + 1;

                if ($copyId >= count($cards)) break;

                $copies[$copyId] += $copies[$id];
            }
        }

        return array_sum($copies);
    }
}