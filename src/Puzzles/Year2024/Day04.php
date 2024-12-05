<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Entry;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Structures\Point;

class Day04 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        /** @var list<Point> $vectors */
        $vectors = [];

        for ($dy = -1; $dy <= 1; $dy++) {
            for ($dx = -1; $dx <= 1; $dx++) {
                $vectors[] = new Point($dx, $dy);
            }
        }

        $grid = Grid::fromInput($input, manipulator: fn(string $char): string => preg_replace('/[^XMAS]/', '.', $char));

        /** @var list<Entry> $xs */
        $xs = array_filter($grid->getEntries(), fn(Entry $entry): bool => $entry->getValue() === 'X');

        $count = 0;

        foreach ($xs as $x) {
            foreach ($vectors as $vector) {
                $pos = new Point($x->getX() + $vector->getX(), $x->getY() + $vector->getY());
                $queue = ['M', 'A', 'S'];

                while (
                    ($val = $grid->getValue($pos->getX(), $pos->getY())) !== '.' &&
                    $val !== 'X' &&
                    count($queue) > 0 &&
                    $val === $queue[0]
                ) {
                    array_shift($queue);
                    $pos = new Point($pos->getX() + $vector->getX(), $pos->getY() + $vector->getY());
                }

                if (count($queue) === 0) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function part2(string $input): int
    {
        $grid = Grid::fromInput($input, manipulator: fn(string $char): string => preg_replace('/[^MAS]/', '.', $char));

        /** @var list<Entry> $as */
        $as = array_filter($grid->getEntries(), fn(Entry $entry): bool => $entry->getValue() === 'A');

        $count = 0;

        foreach ($as as $a) {
            $nw = $grid->getValue($a->getX() - 1, $a->getY() - 1, '.');
            $ne = $grid->getValue($a->getX() + 1, $a->getY() - 1, '.');
            $sw = $grid->getValue($a->getX() - 1, $a->getY() + 1, '.');
            $se = $grid->getValue($a->getX() + 1, $a->getY() + 1, '.');

            if (
                (($nw === 'M' && $se === 'S') || ($nw === 'S' && $se === 'M')) &&
                (($ne === 'M' && $sw === 'S') || ($ne === 'S' && $sw === 'M'))
            ) {
                $count++;
            }
        }

        return $count;
    }
}