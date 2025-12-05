<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Range;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day05 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $data = self::parseInput($input);

        $solution = 0;

        foreach ($data->ingredients as $ingredient) {
            if (Range::someAccept($ingredient, ...$data->ranges)) {
                $solution++;
            }
        }

        return $solution;
    }

    #[Override]
    public function part2(string $input): int
    {
        $data = self::parseInput($input);

        $solution = 0;

        foreach ($data->ranges as $range) {
            $solution += $range->size();
        }

        return $solution;
    }

    /**
     * @param string $input
     * @return object{'ranges': Range[], ingredients: int[]}
     */
    private static function parseInput(string $input): object
    {
        $input = explode("\n\n", $input);
        if (count($input) !== 2) {
            throw new \InvalidArgumentException('Invalid input: should contain two sections separated by two blank lines.');
        }

        [$rangesInput, $ingredientsInput] = $input;

        /** @var Range[] $ranges */
        $ranges = InputManipulator::splitLines($rangesInput, manipulator: function (string $line): Range {
            if (!preg_match('/^(\d+)-(\d+)$/', $line, $matches)) {
                throw new \InvalidArgumentException('Invalid range specification: should be two integers separated by -.');
            }

            return Range::of(intval($matches[1]), intval($matches[2]));
        });

        $ranges = Range::merge(...$ranges);

        $ingredients = InputManipulator::getListOfIntegers($ingredientsInput);

        return (object)compact('ranges', 'ingredients');
    }
}