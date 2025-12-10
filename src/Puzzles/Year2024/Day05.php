<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day05 extends CombinedPuzzleSolver
{
    #[Override]
    protected function solve(string $input): CombinedPuzzleOutput
    {
        $input = self::parse($input);

        $part1 = 0;
        $part2 = 0;

        foreach ($input->updates as $update) {
            $fixed = false;

            do {
                $valid = true;

                for ($i = 0; $i < count($update) - 1; $i++) {
                    $current = $update[$i];
                    $next = $update[$i + 1];

                    if (isset($input->rules[$next]) && in_array($current, $input->rules[$next])) {
                        $update[$i] = $next;
                        $update[$i + 1] = $current;
                        $valid = false;
                        $fixed = true;
                    }
                }
            } while (! $valid);

            if ($fixed) {
                $part2 += $update[(int) floor(count($update) / 2)];
            } else {
                $part1 += $update[(int) floor(count($update) / 2)];
            }
        }

        return CombinedPuzzleOutput::of($part1, $part2);
    }

    /**
     * @return object{rules: array<int, list<int>>, updates: list<list<int>>}
     */
    private static function parse(string $input): object
    {
        $input = explode("\n\n", $input);

        $input[0] = explode("\n", $input[0]);

        /** @var array<int, list<int>> $rules */
        $rules = [];

        foreach ($input[0] as $rule) {
            [$first, $second] = explode('|', $rule, 2);
            $first = intval($first);
            $second = intval($second);

            if (! isset($rules[$first])) {
                $rules[$first] = [];
            }

            $rules[$first][] = $second;
        }

        /** @var list<list<int>> $updates */
        $updates = InputManipulator::splitLines(
            $input[1],
            manipulator: fn (string $update): array => array_map('intval', explode(',', $update)),
        );

        return (object) compact('rules', 'updates');
    }
}
