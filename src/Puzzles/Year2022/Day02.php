<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2022\Day02\Move;
use Knevelina\AdventOfCode\Data\Year2022\Day02\Outcome;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day02 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $games = InputManipulator::splitLines($input, manipulator: fn (string $line): array => [
            Move::fromInput($line[0] ?? '(none)'),
            Move::fromInput($line[2] ?? '(none)'),
        ]);

        $score = 0;

        foreach ($games as $game) {
            /** @var Move $ours */
            /** @var Move $theirs */
            [$theirs, $ours] = $game;
            $outcome = Outcome::fromMoves($ours, $theirs);

            $score += $ours->value;
            $score += $outcome->value;
        }

        return $score;
    }

    #[Override]
    public function part2(string $input): int
    {
        $games = InputManipulator::splitLines($input, manipulator: fn (string $line): array => [
            Move::fromInput($line[0] ?? '(none)'),
            Outcome::fromInput($line[2] ?? '(none)'),
        ]);

        $score = 0;

        foreach ($games as $game) {
            /** @var Move $theirs */
            /** @var Outcome $outcome */
            [$theirs, $outcome] = $game;

            $ours = match ($outcome) {
                Outcome::LOSS => $theirs->getPrey(),
                Outcome::DRAW => $theirs,
                Outcome::WIN => $theirs->getPredator(),
            };

            $score += $ours->value;
            $score += $outcome->value;
        }

        return $score;
    }
}
