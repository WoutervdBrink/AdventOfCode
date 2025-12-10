<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Stack;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day10 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: 'str_split');
        $score = 0;

        foreach ($input as $line) {
            $stack = new Stack;

            foreach ($line as $char) {
                if (in_array($char, ['(', '[', '{', '<'])) {
                    $stack->push($char);
                } else {
                    $open = $stack->pop();

                    $close = match ($open) {
                        '(' => ')',
                        '[' => ']',
                        '{' => '}',
                        '<' => '>',
                        default => '?'
                    };

                    if ($char !== $close) {
                        $score += match ($char) {
                            ')' => 3,
                            ']' => 57,
                            '}' => 1197,
                            '>' => 25137,
                            default => 0
                        };
                        break;
                    }
                }
            }
        }

        return $score;
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: 'str_split');
        $scores = [];

        foreach ($input as $line) {
            $stack = new Stack;

            $illegal = false;

            foreach ($line as $char) {
                if (in_array($char, ['(', '[', '{', '<'])) {
                    $stack->push($char);
                } else {
                    $open = $stack->pop();

                    $close = match ($open) {
                        '(' => ')',
                        '[' => ']',
                        '{' => '}',
                        '<' => '>',
                        default => '?'
                    };

                    if ($char !== $close) {
                        $illegal = true;
                        break;
                    }
                }
            }

            if (! $illegal) {
                $score = 0;

                while ($char = $stack->pop()) {
                    $score *= 5;
                    $score += match ($char) {
                        '(' => 1,
                        '[' => 2,
                        '{' => 3,
                        '<' => 4,
                        default => 0
                    };
                }

                $scores[] = $score;
            }
        }

        sort($scores);

        return $scores[floor(count($scores) / 2)];
    }
}
