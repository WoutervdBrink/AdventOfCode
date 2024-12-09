<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day07 extends CombinedPuzzleSolver
{
    private static function digits(int $n): int
    {
        return intval(log10($n)) + 1;
    }

    private static function endsWith(int $a, int $b): bool
    {
        return ($a - $b) % pow(10, self::digits($b)) === 0;
    }

    private static function isPossible(int $target, array $operands, bool $checkConcat = false): bool
    {
        if (count($operands) === 1) {
            return $operands[0] === $target;
        }

        $tail = array_pop($operands);

        if ($target % $tail === 0 && self::isPossible(intdiv($target, $tail), $operands, $checkConcat)) {
            return true;
        }

        if ($checkConcat) {
            if (
                self::endsWith($target, $tail) &&
                self::isPossible(intdiv($target, (int) pow(10, self::digits($tail))), $operands, $checkConcat)
            ) {
                return true;
            }
        }

        return ($next = $target - $tail) > 0 && self::isPossible($next, $operands, $checkConcat);
    }

    /**
     * @param string $input
     * @return list<object{value: int, operands: list<int>}>
     */
    private static function parse(string $input): array
    {
        return InputManipulator::splitLines(
            $input,
            manipulator: function (string $line): object {
                $line = explode(': ', $line, 2);
                $value = intval($line[0]);
                $operands = array_map('intval', explode(' ', $line[1]));
                return (object)compact('value', 'operands');
            }
        );
    }

    protected function solve(string $input): CombinedPuzzleOutput
    {
        $equations = self::parse($input);

        $part1 = 0;
        $part2 = 0;

        foreach ($equations as $equation) {
            $target = $equation->value;
            if (self::isPossible($target, $equation->operands)) {
                $part1 += $target;
                $part2 += $target;
            } else if (self::isPossible($target, $equation->operands, true)) {
                $part2 += $target;
            }
        }

        return CombinedPuzzleOutput::of($part1, $part2);
    }
}