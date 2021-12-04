<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2021\Bingo;
use Knevelina\AdventOfCode\InputManipulator;

class Day04 implements PuzzleSolver
{
    private static function parseInput(string $input): array
    {
        $input = InputManipulator::splitLines($input);

        $numbers = InputManipulator::splitLines($input[0], ',', 'intval');

        $cards = [];

        for ($card = 0; $card < (count($input) - 1) / 6; $card++) {
            $spec = implode(' ', array_slice($input, $card * 6 + 2, 5));
            $spec = preg_replace('/ +/', ',', $spec);
            $spec = InputManipulator::splitLines($spec, ',', 'intval');
            $cards[] = new Bingo($spec);
        }

        return [$numbers, $cards];
    }

    public function part1(string $input): int
    {
        list($numbers, $cards) = self::parseInput($input);

        foreach ($numbers as $number) {
            /** @var Bingo $card */
            foreach ($cards as $card) {
                $card->mark($number);

                if ($card->hasBingo()) {
                    return array_sum($card->getUnmarkedNumbers()) * $number;
                }
            }
        }

        return 0;
    }

    public function part2(string $input): int
    {
        list($numbers, $cards) = self::parseInput($input);

        $loser = null;

        foreach ($numbers as $number) {
            /** @var Bingo $card */
            foreach ($cards as $card) {
                $card->mark($number);
            }

            $losers = array_filter($cards, fn (Bingo $card): bool => !$card->hasBingo());

            if (count($losers) === 1) {
                $loser = $losers[array_key_first($losers)];
            }

            if (count($losers) === 0) {
                return array_sum($loser->getUnmarkedNumbers()) * $number;
            }
        }

        return 0;
    }
}