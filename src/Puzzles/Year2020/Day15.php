<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class Day15 implements PuzzleSolver
{
    private array $say;
    private array $history;

    private function say(int $turn, int $num): void
    {
        $this->say[$turn] = $num;

        if (!isset($this->history[$num])) {
            $this->history[$num] = [];
        }

        $this->history[$num][] = $turn;

        if (count($this->history[$num]) === 3) {
            array_shift($this->history[$num]);
        }
    }

    private function lastSaidBefore(int $turn): bool
    {
        if (!isset($this->say[$turn - 1])) {
            return false;
        }

        $last = $this->say[$turn - 1];

        return count($this->history[$last] ?? []) > 1;
    }

    private function getLastTwoTurns(int $turn): array
    {
        $last = $this->say[$turn - 1];

        $history = $this->history[$last];

        return [$history[count($history) - 2], $history[count($history) - 1]];
    }

    private function calculate(string $input, int $n): int
    {
        $input = explode(',', trim($input));
        $input = array_map(fn (string $num): int => intval($num), $input);
        $nums = [];
        for ($i = 0; $i < count($input) - 1; $i++) {
            $num = $input[$i];
            $nums[$num] = $i;
        }
        $last = last($input);

        for ($i = count($input); $i < $n; $i++) {
            $next = match(true) {
                isset($nums[$last]) => $i - $nums[$last] - 1,
                default => 0
            };

            $nums[$last] = $i - 1;
            $last = $next;
        }

        return $last;
    }

    public function part1(string $input): int
    {
        return $this->calculate($input, 2020);
    }

    public function part2(string $input): int
    {
        return $this->calculate($input, 30000000);
    }
}