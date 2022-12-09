<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Map;
use Knevelina\AdventOfCode\Data\Year2022\Day08\Tree;
use Knevelina\AdventOfCode\InputManipulator;

class Day08 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $treeMap = self::parseInput($input);

        foreach ($treeMap->getRowsAndColumns() as $treeLine) {
            self::analyzeTreeLine($treeLine);
            self::analyzeTreeLine(array_reverse($treeLine));
        }

        return count(array_filter($treeMap->getValues(), fn(Tree $tree): bool => $tree->isVisible()));
    }

    private static function parseInput(string $input): Map
    {
        /** @var array<array<Tree>> $trees */
        $trees = InputManipulator::splitLines($input, manipulator: fn(string $line): array => array_map(
            fn(string $char): Tree => new Tree(intval($char)),
            str_split($line)
        ));

        return new Map($trees);
    }

    private static function analyzeTreeLine(array $treeLine): void
    {
        $obstruction = -1;

        /** @var Tree $tree */
        foreach ($treeLine as $tree) {
            $value = $tree->getValue();

            if ($value > $obstruction) {
                $tree->show();
                $obstruction = $value;
            }
        }
    }

    public function part2(string $input): int
    {
        $treeMap = self::parseInput($input);

        foreach ($treeMap->getRowsAndColumns() as $treeLine) {
            self::calculateScenicScores($treeLine);
            self::calculateScenicScores(array_reverse($treeLine));
        }

        return array_reduce(
            $treeMap->getValues(),
            fn(int $max, Tree $tree): int => max($tree->getScore(), $max),
            0
        );
    }

    /**
     * @param array<Tree> $treeLine
     * @return void
     */
    private static function calculateScenicScores(array $treeLine): void
    {
        for ($t = 0; $t < count($treeLine); $t++) {
            $tree = $treeLine[$t];
            $value = $tree->getValue();
            $visibleTrees = 0;

            for ($x = $t + 1; $x < count($treeLine); $x++) {
                $visibleTrees++;
                if ($treeLine[$x]->getValue() >= $value) {
                    break;
                }
            }

            $tree->pushScore($visibleTrees);
        }
    }
}