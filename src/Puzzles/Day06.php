<?php


namespace Knevelina\AdventOfCode\Puzzles;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day06 implements PuzzleSolver
{

    public function part1(string $input): int
    {
        $groups = InputManipulator::splitLines($input, "\n\n");

        $value = 0;

        foreach ($groups as $group) {
            $group = str_replace("\n", '', $group);
            $group = str_split($group);
            sort($group);
            $value += count(array_unique($group));
        }

        return $value;
    }

    public function part2(string $input): int
    {
        $groups = InputManipulator::splitLines($input, "\n\n");

        $value = 0;

        foreach ($groups as $group) {
            $answers = explode("\n", $group);
            $answers = array_map(fn (string $answer): array => str_split($answer), $answers);

            $common = call_user_func_array('array_intersect', $answers);

            $value += count($common);
        }

        return $value;
    }
}