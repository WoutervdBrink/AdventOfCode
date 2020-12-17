<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\GameOfLife3D;
use Knevelina\AdventOfCode\Data\Year2020\GameOfLife4D;
use Knevelina\AdventOfCode\InputManipulator;

class Day17 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $game = new GameOfLife3D();

        foreach ($input as $y => $line) {
            $line = str_split(trim($line));

            foreach ($line as $x => $cube) {
                $game->setCube($x, $y, 0, $cube === '#');
            }
        }

        for ($i = 0; $i < 6; $i++) {
            $game = $game->evolve();
        }

        return $game->getActiveCubes();
    }

    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input);
        $game = new GameOfLife4D();

        foreach ($input as $y => $line) {
            $line = str_split(trim($line));

            foreach ($line as $x => $cube) {
                $game->setCube($x, $y, 0, 0, $cube === '#');
            }
        }

        for ($i = 0; $i < 6; $i++) {
            $game = $game->evolve();
        }

        return $game->getActiveCubes();
    }
}