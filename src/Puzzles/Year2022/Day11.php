<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2022\Day11\Monkey;
use Knevelina\AdventOfCode\Data\Year2022\Day11\Operations;
use Knevelina\AdventOfCode\InputManipulator;
use Symfony\Component\Console\Input\Input;

class Day11 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $monkeys = InputManipulator::splitLines($input, delimiter: "\n\n", manipulator: function (string $lines): Monkey {
            $lines = InputManipulator::splitLines($lines, manipulator: 'trim');

            // Monkey 0:
            // Starting items: 1, 2, 3
            $items = InputManipulator::splitLines(substr($lines[1], 16), delimiter: ',', manipulator: 'intval');
            // Operation: new = old <operator> <argument>
            if (!preg_match('/^Operation: new = old ([*+]) (old|\d+)$/', $lines[2], $matches)) {
                throw new \RuntimeException(sprintf('Invalid operation description "%s"', $lines[2]));
            }

            if ($matches[1] === '+') {
                $operation = new Operations\Add(intval($matches[2]));
            } elseif ($matches[2] === 'old') {
                $operation = new Operations\Square();
            } else {
                $operation = new Operations\Multiply(intval($matches[2]));
            }

            // Test: divisible by 123
            $modulus = intval(substr($lines[3], 19));

            // If true: throw to monkey 123
            $trueMonkey = intval(substr($lines[4], 25));

            // If false: throw to monkey 123
            $falseMonkey = intval(substr($lines[5], 26));

            return new Monkey(
                $modulus,
                $operation,
                $trueMonkey,
                $falseMonkey,
                $items
            );
        });

        var_dump($monkeys);

        return 0;
    }

    public function part2(string $input): int
    {
        return 0;
    }
}