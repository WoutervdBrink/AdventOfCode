<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\ShuntingYard;
use Knevelina\AdventOfCode\InputManipulator;
use RuntimeException;

class Day18 implements PuzzleSolver
{
    private static function calculate(array $rpn): int
    {
        $stack = [];

        while ($rpn) {
            $token = array_shift($rpn);

            if (is_numeric($token)) {
                $stack[] = $token;
            } else {
                $op1 = array_pop($stack);
                $op2 = array_pop($stack);

                $res = match ($token) {
                    '+' => $op1 + $op2,
                    '-' => $op1 - $op2,
                    '*' => $op1 * $op2,
                    default => throw new RuntimeException(sprintf('Unknown operator "%s"', $token))
                };

                $stack[] = $res;
            }
        }

        return last($stack);
    }

    private static function execute(ShuntingYard $converter, string $input): int
    {
        $sum = 0;

        foreach (InputManipulator::splitLines($input) as $expression) {
            $rpn = $converter->convert($expression);

            $sum += self::calculate($rpn);
        }

        return $sum;
    }

    public function part1(string $input): int
    {
        $converter = new ShuntingYard();

        $converter->addOperator('+', 2, ShuntingYard::LEFT)
            ->addOperator('-', 2, ShuntingYard::LEFT)
            ->addOperator('*', 2, ShuntingYard::LEFT);

        return self::execute($converter, $input);
    }

    public function part2(string $input): int
    {
        $converter = new ShuntingYard();

        $converter->addOperator('+', 3, ShuntingYard::LEFT)
            ->addOperator('-', 3, ShuntingYard::LEFT)
            ->addOperator('*', 2, ShuntingYard::LEFT);

        return self::execute($converter, $input);
    }
}