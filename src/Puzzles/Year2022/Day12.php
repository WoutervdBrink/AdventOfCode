<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Entry;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use SplQueue;

class Day12 implements PuzzleSolver
{
    const START = 0;

    const END = 27;

    #[Override]
    public function part1(string $input): int
    {
        $grid = self::parseInput($input);

        $end = null;

        foreach ($grid->getEntries() as $entry) {
            if ($entry->getValue() === self::END) {
                $end = $entry;
            }
        }

        assert(! is_null($end));

        $queue = new SplQueue;
        $visited = [];

        $queue->enqueue([$end]);

        while ($queue->count()) {
            $path = $queue->dequeue();

            /** @var Entry $entry */
            $entry = $path[count($path) - 1];
            $value = $entry->getValue();

            if ($value === self::START) {
                return count($path) - 1;
            }

            foreach ($entry->getNeighbors(false) as $neighbor) {
                if ($value > $neighbor->getValue() + 1) {
                    continue;
                }

                if (in_array($neighbor, $visited, true)) {
                    continue;
                }

                $visited[] = $neighbor;

                $queue->enqueue([...$path, $neighbor]);
            }
        }

        return 0;
    }

    private static function parseInput(string $input): Grid
    {
        $input = InputManipulator::splitLines($input, manipulator: fn (string $line): array => array_map(
            fn (string $char): int => match ($char) {
                'S' => self::START,
                'E' => self::END,
                default => ord($char) - ord('a') + 1
            },
            str_split($line)
        ));

        return new Grid($input);
    }

    #[Override]
    public function part2(string $input): int
    {
        $grid = self::parseInput($input);

        $shortestPath = INF;

        $end = null;

        foreach ($grid->getEntries() as $entry) {
            if ($entry->getValue() === self::END) {
                $end = $entry;
            }
        }

        assert(! is_null($end));

        $queue = new SplQueue;
        $visited = [];

        $queue->enqueue([$end]);

        while ($queue->count()) {
            $path = $queue->dequeue();

            /** @var Entry $entry */
            $entry = $path[count($path) - 1];
            $value = $entry->getValue();

            if ($value === 1) {
                $shortestPath = min(count($path) - 1, $shortestPath);
            }

            foreach ($entry->getNeighbors(false) as $neighbor) {
                if ($value > $neighbor->getValue() + 1) {
                    continue;
                }

                if (in_array($neighbor, $visited, true)) {
                    continue;
                }

                $visited[] = $neighbor;

                $queue->enqueue([...$path, $neighbor]);
            }
        }

        return $shortestPath;
    }
}
