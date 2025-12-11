<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day09 implements PuzzleSolver
{
    /**
     * @return object{x: int, y: int}[]
     */
    private static function parse(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): object {
            [$x, $y] = explode(',', $line, 2);

            return (object) compact('x', 'y');
        });
    }

    #[Override]
    public function part1(string $input): int
    {
        $points = self::parse($input);

        $max = 0;

        for ($i = 0; $i < count($points); $i++) {
            for ($j = $i + 1; $j < count($points); $j++) {
                $width = abs($points[$i]->x - $points[$j]->x) + 1;
                $height = abs($points[$i]->y - $points[$j]->y) + 1;
                $area = $width * $height;

                $max = max($max, $area);
            }
        }

        return $max;
    }

    #[Override]
    public function part2(string $input): int
    {
        $points = self::parse($input);

        /** @var array{0: object{x: int, y: int}, 1: object{x: int, y: int}}[] $lines */
        $lines = [];

        for ($i = 0; $i < count($points); $i++) {
            $current = $points[$i];
            $next = $points[($i + 1) % count($points)];

            $lines[] = [$current, $next];
            $lines[] = [$next, $current];
        }

        /** @var object{x1: int, x2: int, y1: int, y2: int, area: int}[] $rectangles */
        $rectangles = [];
        for ($i = 0; $i < count($points); $i++) {
            for ($j = $i + 1; $j < count($points); $j++) {
                $from = $points[$i];
                $to = $points[$j];

                $rectangles[] = (object) [
                    'x1' => min($from->x, $to->x),
                    'y1' => min($from->y, $to->y),
                    'x2' => max($from->x, $to->x),
                    'y2' => max($from->y, $to->y),
                    'area' => (abs($from->x - $to->x) + 1) * (abs($from->y - $to->y) + 1),
                ];
            }
        }

        usort($rectangles, fn ($a, $b) => $b->area <=> $a->area);

        foreach ($rectangles as $rectangle) {
            $problem = false;

            foreach ($lines as [$from, $to]) {
                if (
                    $from->x < $rectangle->x2 && $from->y < $rectangle->y2 &&
                    $to->x > $rectangle->x1 && $to->y > $rectangle->y1
                ) {
                    $problem = true;
                    break;
                }
            }

            if (! $problem) {
                return $rectangle->area;
            }
        }

        return 0;
    }
}
