<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2015\AdvancedLightGrid;
use Knevelina\AdventOfCode\Data\Year2015\LightGrid;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day06 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        return $this->parseInput(new LightGrid, $input)->getEnabledLights();
    }

    private function parseInput(LightGrid $grid, string $input): LightGrid
    {
        $input = InputManipulator::splitLines($input);

        foreach ($input as $instruction) {
            if (! preg_match('/^(turn on|toggle|turn off) (\d+),(\d+) through (\d+),(\d+)/', $instruction, $matches)) {
                throw new RuntimeException(sprintf('Could not parse lights instruction "%s"!', $instruction));
            }

            $fromRow = intval($matches[2]);
            $fromCol = intval($matches[3]);
            $toRow = intval($matches[4]);
            $toCol = intval($matches[5]);

            switch ($matches[1]) {
                case 'turn on':
                    $grid->turnOn($fromRow, $fromCol, $toRow, $toCol);
                    break;
                case 'toggle':
                    $grid->toggle($fromRow, $fromCol, $toRow, $toCol);
                    break;
                case 'turn off':
                    $grid->turnOff($fromRow, $fromCol, $toRow, $toCol);
                    break;
            }
        }

        return $grid;
    }

    #[Override]
    public function part2(string $input): int
    {
        /** @var AdvancedLightGrid $grid */
        $grid = $this->parseInput(new AdvancedLightGrid, $input);

        return $grid->getBrightness();
    }
}
