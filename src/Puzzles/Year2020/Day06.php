<?php


namespace Knevelina\AdventOfCode\Puzzles\Year2020;


use Illuminate\Support\Collection;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day06 implements PuzzleSolver
{

    public function part1(string $input): int
    {
        return collect(InputManipulator::splitLines($input, "\n\n"))
            ->map(fn (string $group): int =>
                collect(str_split(str_replace("\n", '', $group)))
                    ->unique()
                    ->count()
            )
            ->sum();
    }

    public function part2(string $input): int
    {
        return collect(InputManipulator::splitLines($input, "\n\n"))
            ->map(callback: fn (string $group): int =>
                collect(explode("\n", $group))
                    ->map(fn (string $answer): array => str_split($answer))
                    ->reduce(callback: fn (?Collection $intersect, array $answer):
                        Collection => $intersect ?
                            $intersect->intersect($answer) :
                            collect($answer)
                    )
                    ->count()
            )
            ->sum();
    }
}