<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2021;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\InputManipulator;

class Day13 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $map = $this->solve($input, 1);

        $sum = 0;
        for ($x = 0; $x < $map->getWidth(); $x++) {
            for ($y = 0; $y < $map->getHeight(); $y++) {
                $sum += $map->getValue($x, $y);
            }
        }
        return $sum;
    }

    private function solve(string $input, int $part): Grid
    {
        list($dots, $instructions) = explode("\n\n", $input, 2);

        $dots = InputManipulator::splitLines($dots, manipulator: fn(string $line): array => explode(',', trim($line), 2)
        );

        $width = 0;
        $height = 0;

        foreach ($dots as $dot) {
            list ($x, $y) = $dot;

            $width = max($width, $x);
            $height = max($height, $y);
        }

        $width++;
        $height++;

        $map = Grid::emptyFromDimensions($width, $height);

        foreach ($dots as $dot) {
            list ($x, $y) = $dot;

            $map->setValue($x, $y, 1);
        }

        $instructions = InputManipulator::splitLines($instructions);

        for ($i = 0; $i < ($part === 1 ? 1 : count($instructions)); $i++) {
            if (!preg_match('/^fold along ([xy])=(\d+)$/', $instructions[$i], $matches)) {
                throw new \RuntimeException(sprintf('Could not parse instruction %s', $instructions[0]));
            }

            $direction = $matches[1];
            $value = intval($matches[2]);
            $newWidth = $direction === 'x' ? $value : $width;
            $newHeight = $direction === 'y' ? $value : $height;
            $next = Grid::emptyFromDimensions($newWidth, $newHeight);

            for ($x = 0; $x < $width; $x++) {
                for ($y = 0; $y < $height; $y++) {
                    if ($map->getValue($x, $y) === 0) {
                        continue;
                    }

                    if ($next->isWithinBounds($x, $y)) {
                        $next->setValue($x, $y, 1);
                    } else {
                        $xx = match ($direction) {
                            'x' => $width - $x - 1,
                            default => $x
                        };
                        $yy = match ($direction) {
                            'y' => $height - $y - 1,
                            default => $y
                        };
                        if ($next->isWithinBounds($xx, $yy)) {
                            $next->setValue($xx, $yy, 1);
                        }
                    }
                }
            }
            $map = $next;
        }


        return $map;
    }

    public function part2(string $input): int
    {
        $map = $this->solve($input, 2);
        echo $map;

        return 0;
    }
}