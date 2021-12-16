<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2021\Cave;
use Knevelina\AdventOfCode\InputManipulator;

class Day12 implements PuzzleSolver
{

    public function part1(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: fn(string $line): array => explode('-', $line, 2));

        $caves = [];

        foreach ($input as $edge) {
            list ($from, $to) = $edge;
            if (!isset($caves[$from])) {
                $caves[$from] = new Cave($from);
            }
            if (!isset($caves[$to])) {
                $caves[$to] = new Cave($to);
            }
            $from = $caves[$from];
            $to = $caves[$to];
            $from->connect($to);
            $to->connect($from);
        }

        $start = $caves['start'];

        return $this->visitPart1($start, [], 0);
    }

    private function visitPart1(Cave $cave, array $visited): int
    {
        $routes = 0;

        $visited[$cave->getName()] = true;

        foreach ($cave->getConnections() as $connection) {
            if ($connection->isSmall() && isset($visited[$connection->getName()])) {
                continue;
            }

            if ($connection->getName() === 'end') {
                $routes++;
                continue;
            }

            $routes += $this->visitPart1($connection, $visited);
        }

        return $routes;
    }

    public function part2(string $input): int
    {
        $input = InputManipulator::splitLines($input, manipulator: fn(string $line): array => explode('-', $line, 2));

        $caves = [];

        foreach ($input as $edge) {
            list ($from, $to) = $edge;
            if (!isset($caves[$from])) {
                $caves[$from] = new Cave($from);
            }
            if (!isset($caves[$to])) {
                $caves[$to] = new Cave($to);
            }
            $from = $caves[$from];
            $to = $caves[$to];
            $from->connect($to);
            $to->connect($from);
        }

        $start = $caves['start'];

        return $this->visitPart2($start, [], false);
    }

    private function visitPart2(Cave $cave, array $visited, bool $visitedSmall): int
    {
        if ($cave->getName() === 'end') {
            return 1;
        }

        if (isset($visited[$cave->getName()])) {
            if ($cave->getName() === 'start') {
                return 0;
            }
            if ($cave->isSmall()) {
                if ($visitedSmall) {
                    return 0;
                }
                $visitedSmall = true;
            }
        }

        $visited[$cave->getName()] = true;

        $routes = 0;

        foreach ($cave->getConnections() as $connection) {
            $routes += $this->visitPart2($connection, $visited, $visitedSmall);
        }

        return $routes;
    }
}