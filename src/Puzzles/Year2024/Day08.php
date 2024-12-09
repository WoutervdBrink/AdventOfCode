<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Entry;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Structures\Point;

class Day08 extends CombinedPuzzleSolver
{
    protected function solve(string $input): CombinedPuzzleOutput
    {
        $grid = Grid::fromInput($input, manipulator: 'strval');

        /** @var array<string, list<Entry>> $antennas */
        $antennas = [];

        foreach ($grid->getEntries() as $entry) {
            if (($freq = $entry->getValue()) !== '.') {
                if (!isset($antennas[$freq])) {
                    $antennas[$freq] = [];
                }

                $antennas[$freq][] = $entry;
            }
        }

        /** @var list<Point> $part1nodes */
        $part1nodes = [];

        /** @var list<Point> $part2nodes */
        $part2nodes = [];

        foreach ($antennas as $entries) {
            for ($i = 0; $i < count($entries); $i++) {
                for ($j = $i + 1; $j < count($entries); $j++) {
                    $first = $entries[$i];
                    $second = $entries[$j];

                    $dx = ($first->getX() - $second->getX());
                    $dy = ($first->getY() - $second->getY());

                    $part1nodes[] = new Point($first->getX() + $dx, $first->getY() + $dy);
                    $part1nodes[] = new Point($second->getX() - $dx, $second->getY() - $dy);

                    $x = $first->getX();
                    $y = $first->getY();

                    while ($grid->isWithinBounds($x, $y)) {
                        $part2nodes[] = new Point($x, $y);
                        $x += $dx;
                        $y += $dy;
                    }

                    $x = $second->getX();
                    $y = $second->getY();

                    while ($grid->isWithinBounds($x, $y)) {
                        $part2nodes[] = new Point($x, $y);
                        $x -= $dx;
                        $y -= $dy;
                    }
                }
            }
        }

        $part1 = 0;
        $part2 = 0;

        foreach ($part1nodes as $point) {
            $x = $point->getX();
            $y = $point->getY();

            if ($grid->isWithinBounds($x, $y)) {
                if ($grid->getValue($x, $y) === '#') {
                    continue;
                }

                $grid->setValue($x, $y, '#');
                $part1++;
                $part2++;
            }
        }

        foreach ($part2nodes as $point) {
            $x = $point->getX();
            $y = $point->getY();

            if ($grid->isWithinBounds($x, $y)) {
                if ($grid->getValue($x, $y) === '#') {
                    continue;
                }

                $grid->setValue($x, $y, '#');
                $part2++;
            }
        }

        return CombinedPuzzleOutput::of($part1, $part2);
    }
}