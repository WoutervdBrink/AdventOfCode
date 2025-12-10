<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Entry;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Year2025\Day04\Mark;
use Override;

class Day04 implements PuzzleSolver
{
    private static function canAccess(Grid $grid, int $x, int $y): bool
    {
        $value = $grid->getValue($x, $y);

        if ($value !== Mark::PAPER) {
            return false;
        }
        $neighbors = $grid->getNeighborValues($x, $y);

        if (count(array_filter($neighbors, fn (Mark $mark): bool => $mark !== Mark::EMPTY)) < 4) {
            return true;
        }

        return false;
    }

    private static function canRemove(Entry $entry): bool
    {
        if ($entry->getValue() !== Mark::PAPER) {
            return false;
        }

        $neighbors = 0;

        foreach ($entry->getNeighbors() as $neighbor) {
            if ($neighbor->getValue() === Mark::PAPER) {
                $neighbors++;
            }
        }

        return $neighbors < 4;
    }

    #[Override]
    public function part1(string $input): int
    {
        $grid = self::parseInput($input);
        $solution = 0;

        for ($y = 0; $y < $grid->getHeight(); $y++) {
            for ($x = 0; $x < $grid->getWidth(); $x++) {
                if (self::canAccess($grid, $x, $y)) {
                    $solution++;
                }
            }
        }

        return $solution;
    }

    private static function parseInput(string $input): Grid
    {
        return Grid::fromInput($input, manipulator: fn (string $char): Mark => Mark::from($char));
    }

    #[Override]
    public function part2(string $input): int
    {
        $grid = self::parseInput($input);
        $solution = 0;

        do {
            /** @var Entry[] $toRemove */
            $toRemove = [];

            foreach ($grid->getEntries() as $entry) {
                if (self::canRemove($entry)) {
                    $toRemove[] = $entry;
                    $solution++;
                }
            }

            foreach ($toRemove as $entry) {
                $entry->setValue(Mark::EMPTY);
            }
        } while (! empty($toRemove));

        return $solution;
    }
}
