<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Year2025\Day06\Op;
use Override;

class Day06 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $grid = self::parse($input);

        /** @var object{start: int, length: int}[] $problems */
        $problems = [];

        /** @var object{start: int, length: int} $problem */
        $problem = (object) ['start' => 0, 'length' => 0];

        $grandTotal = 0;

        for ($x = 0; $x < $grid->getWidth(); $x++) {
            $empty = true;
            for ($y = 0; $y < $grid->getHeight(); $y++) {
                if ($grid->getValue($x, $y) !== ' ') {
                    $empty = false;
                    break;
                }
            }

            if ($empty) {
                $problems[] = $problem;
                $problem = (object) ['start' => $x + 1, 'length' => 0];
            } else {
                $problem->length++;
            }
        }

        if ($problem->length) {
            $problems[] = $problem;
        }

        foreach ($problems as $problem) {
            $op = Op::from($grid->getValue($problem->start, $grid->getHeight() - 1));
            $operands = [];

            for ($y = 0; $y < $grid->getHeight() - 1; $y++) {
                $operand = 0;
                for ($x = $problem->start; $x < $problem->start + $problem->length; $x++) {
                    $val = $grid->getValue($x, $y);
                    if ($val !== ' ') {
                        $operand *= 10;
                        $operand += intval($val);
                    }
                }
                $operands[] = $operand;
            }

            $result = (int) match ($op) {
                Op::PLUS => array_sum($operands),
                Op::TIMES => array_reduce($operands, fn ($a, $b): float => $a * $b, 1),
            };

            $grandTotal += $result;
        }

        return $grandTotal;
    }

    private static function parse(string $input): Grid
    {
        return Grid::fromInput($input, 'strval');
    }

    #[Override]
    public function part2(string $input): int
    {
        $grid = self::parse($input);
        $grandTotal = 0;

        $op = Op::from($grid->getValue(0, $grid->getHeight() - 1));
        $operands = [];

        for ($x = 0; $x < $grid->getWidth(); $x++) {
            $empty = true;
            $operand = 0;

            for ($y = 0; $y < $grid->getHeight() - 1; $y++) {
                $val = $grid->getValue($x, $y);

                if ($val !== ' ') {
                    $operand *= 10;
                    $operand += intval($val);
                    $empty = false;
                }
            }

            if (! $empty) {
                $operands[] = $operand;
            } else {
                $grandTotal += (int) match ($op) {
                    Op::PLUS => array_sum($operands),
                    Op::TIMES => array_reduce($operands, fn ($a, $b): float => $a * $b, 1),
                };

                $op = Op::from($grid->getValue($x + 1, $grid->getHeight() - 1, '+'));
                $operands = [];
            }
        }

        if (! empty($operands)) {
            $grandTotal += (int) match ($op) {
                Op::PLUS => array_sum($operands),
                Op::TIMES => array_reduce($operands, fn ($a, $b): float => $a * $b, 1),
            };
        }

        return $grandTotal;
    }
}
