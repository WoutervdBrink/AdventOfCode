<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Queue;
use Knevelina\AdventOfCode\InputManipulator;

class Day10 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: 'str_split');
        $score = 0;

        foreach ($input as $line) {
            $q = new Queue();

            foreach ($line as $char) {
                if (in_array($char, ['(', '[', '{', '<'])) {
                    $q->push($char);
                } else {
                    $open = $q->pop();

                    $close = match($open) {
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

    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: 'str_split');
        $scores = [];

        foreach ($input as $line) {
            $q = new Queue();

            foreach ($line as $char) {
                $illegal = false;
                if (in_array($char, ['(', '[', '{', '<'])) {
                    $q->push($char);
                } else {
                    $open = $q->pop();

                    $close = match($open) {
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
                        $illegal = true;
                        break;
                    }
                }
            }

            if (!$illegal) {
                $score = 0;

                while ($char = $q->pop()) {
                    $score *= 5;
                    $score += match($char) {
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

        return $scores[count($scores) / 2];
    }
}