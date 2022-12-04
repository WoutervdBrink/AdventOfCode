<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day03 implements PuzzleSolver
{
    public static function getPriority(string $item): int
    {
        $ord = ord($item);

        if ($ord >= 65 && $ord <= 90) {
            return $ord - 38;
        }

        if ($ord >= 97 && $ord <= 122) {
            return $ord - 96;
        }

        throw new InvalidArgumentException(sprintf('"%s" is not a valid ruckrack item', $item));
    }

    public function part1(string $input): int
    {
        $rucksacks = InputManipulator::splitLines($input, manipulator: fn(string $rucksack): array => [
            substr($rucksack, 0, intval(strlen($rucksack) / 2)),
            substr($rucksack, intval(strlen($rucksack) / 2)),
        ]);

        $sum = 0;

        foreach ($rucksacks as $rucksack) {
            [$first, $second] = $rucksack;

            $intersect = array_values(array_intersect(str_split($first), str_split($second)));

            $sum += self::getPriority($intersect[0] ?? '(none)');
        }

        return $sum;
    }

    public function part2(string $input): int
    {
        $rucksacks = InputManipulator::splitLines($input, manipulator: 'str_split');
        $groups = count($rucksacks) / 3;
        $sum = 0;

        for ($group = 0; $group < $groups; $group++) {
            $groupSacks = array_slice($rucksacks, $group * 3, 3);

            $letter = array_values(array_intersect(...$groupSacks));

            $sum += self::getPriority($letter[0] ?? '(none)');
        }

        return $sum;
    }
}