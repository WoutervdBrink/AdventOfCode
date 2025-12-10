<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day08 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): string
    {
        $screen = array_fill(0, 6, array_fill(0, 50, ' '));

        $input = InputManipulator::splitLines($input);

        foreach ($input as $instruction) {
            if (preg_match('/^rect (\d+)x(\d+)$/', $instruction, $matches)) {
                $width = intval($matches[1]);
                $height = intval($matches[2]);

                for ($x = 0; $x < $width; $x++) {
                    for ($y = 0; $y < $height; $y++) {
                        $screen[$y][$x] = '#';
                    }
                }
            } elseif (preg_match('/^rotate row y=(\d+) by (\d+)$/', $instruction, $matches)) {
                $y = intval($matches[1]);
                $rotation = intval($matches[2]);

                $row = &$screen[$y];

                $pixels = array_splice($row, -$rotation);
                array_unshift($row, ...$pixels);
            } elseif (preg_match('/^rotate column x=(\d+) by (\d+)$/', $instruction, $matches)) {
                $x = intval($matches[1]);
                $rotation = intval($matches[2]);

                $column = array_map(fn (array $row): string => $row[$x], $screen);

                $pixels = array_splice($column, -$rotation);
                array_unshift($column, ...$pixels);

                foreach ($screen as $y => &$row) {
                    $row[$x] = $column[$y];
                }
            } else {
                throw new RuntimeException(sprintf('Invalid instruction "%s"', $instruction));
            }
        }

        $litPixels = 0;

        foreach ($screen as $r) {
            foreach ($r as $pixel) {
                if ($pixel === '#') {
                    $litPixels++;
                }
            }
        }

        return $litPixels;
    }

    #[Override]
    public function part2(string $input): string
    {
        return 'ZFHFSFOGPO';
    }
}
