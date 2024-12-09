<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day07 extends CombinedPuzzleSolver
{
    private static function testCalculation(int $target, int $cursor, array $operands, bool $withConcat = false): int
    {
        if (count($operands) === 0) {
            return $cursor === $target
                ? $target
                : 0;
        }

        if ($cursor === 0) {
            $cursor = array_shift($operands);
        }

        $operand = array_shift($operands);

//        echo '    Trying if ' . $target . ' = ' . $cursor . ' + ' . $operand . ' ... ' . implode( ' ', $operands ) . PHP_EOL;
        if (self::testCalculation($target, $cursor + $operand, $operands, $withConcat) > 0) {
            return $target;
        }

//        echo '    Trying if ' . $target . ' = ' . $cursor . ' * ' . $operand . ' ... ' . implode( ' ', $operands ) . PHP_EOL;
        if (self::testCalculation($target, $cursor * $operand, $operands, $withConcat) > 0) {
            return $target;
        }

        if ($withConcat) {
//            echo '    Trying if ' . $target . ' = ' . $cursor . ' || ' . $operand . ' ... ' . implode( ' ', $operands ) . PHP_EOL;
            if (self::testCalculation($target, intval($cursor . $operand), $operands, true) > 0) {
                return $target;
            }
        }

        return 0;
    }

    public function part1(string $input): int
    {
        $equations = self::parse($input);

        $sum = 0;

        foreach ($equations as $equation) {
            $target = $equation->value;
            $sum += self::testCalculation($target, 0, [...$equation->operands]);
        }

        return $sum;
    }

    public function part2(string $input): int
    {
        $equations = self::parse($input);

        $sum = 0;

        foreach ($equations as $equation) {
            $target = $equation->value;

            if ($res = self::testCalculation($target, 0, [...$equation->operands], true)) {
                $sum += $res;
            }
        }

        return $sum;
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
            $part1 += ($val = self::testCalculation($target, 0, [...$equation->operands]));
            if ($val === 0) {
                $part2 += self::testCalculation($target, 0, [...$equation->operands], true);
            } else {
                $part2 += $val;
            }
        }

        return CombinedPuzzleOutput::of($part1, $part2);
    }
}