<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2024;

use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Direction;
use Knevelina\AdventOfCode\Data\Structures\Grid\Entry;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\Data\Structures\Point;

class Day06 extends CombinedPuzzleSolver
{
    protected function solve(string $input): CombinedPuzzleOutput
    {
        $grid = Grid::fromInput($input, manipulator: 'strval');
        $guard = collect($grid->getEntries())
            ->filter(fn(Entry $entry): bool => $entry->getValue() === '^')
            ->firstOrFail();

        $x = $guard->getX();
        $y = $guard->getY();

        $direction = Direction::UP;

        $part1 = [];

        $jumpTable = [];

        do {
            $key = self::encodeCoordinates($grid, $x, $y);

            if (!isset($jumpTable[$key])) {
                $nextX = $x;
                $nextY = $y;

                do {
                    $nextX = $nextX + $direction->getHorizontalMovement();
                    $nextY = $nextY + $direction->getVerticalMovement();
                    $nextValue = $grid->getValue($nextX, $nextY, ' ');
                    if ($nextValue !== '#' && $nextValue !== ' ') {
                        $part1[self::encodeCoordinates($grid, $nextX, $nextY)] = true;
                    }
                } while ($nextValue !== '#' && $nextValue !== ' ');

                if ($nextValue === '#') {
                    $nextX = $nextX - $direction->getHorizontalMovement();
                    $nextY = $nextY - $direction->getVerticalMovement();
                    $direction = $direction->clockwise();
                }

                $jumpTable[$key] = (object)[
                    'x' => $nextX,
                    'y' => $nextY,
                    'direction' => $direction,
                ];
            }

            $next = $jumpTable[$key];
            $x = $next->x;
            $y = $next->y;
            $direction = $next->direction;

        } while ($grid->isWithinBounds($x, $y));

        $part2 = 0;

        foreach ($part1 as $key => $_) {
            $x = $guard->getX();
            $y = $guard->getY();
            $direction = Direction::UP;
            $obs = self::decodeCoordinates($grid, $key);
            $obsX = $obs->getX();
            $obsY = $obs->getY();
            $seen = $part1;
            foreach ($seen as &$entry) {
                $entry = [];
            }
            /** @var array<int, array> $seen */

            do {
                $key = self::encodeCoordinates($grid, $x, $y);

                if (!isset($jumpTable[$key]) || $x === $obsX || $y === $obsY) {
                    $nextX = $x;
                    $nextY = $y;

                    do {
                        $nextX = $nextX + $direction->getHorizontalMovement();
                        $nextY = $nextY + $direction->getVerticalMovement();
                        $nextValue = $grid->getValue($nextX, $nextY, ' ');
                    } while ($nextValue !== '#' && $nextValue !== ' ' && !($nextX === $obsX && $nextY === $obsY));

                    if ($nextValue === '#' || ($nextX === $obsX && $nextY === $obsY)) {
                        $nextX = $nextX - $direction->getHorizontalMovement();
                        $nextY = $nextY - $direction->getVerticalMovement();
                        $direction = $direction->clockwise();
                    }

                    $x = $nextX;
                    $y = $nextY;
                } else {
                    $next = $jumpTable[$key];
                    $x = $next->x;
                    $y = $next->y;
                    $direction = $next->direction;
                }

                if (isset($seen[self::encodeCoordinates($grid, $x, $y)][$direction->value])) {
                    $grid->setValue($obsX, $obsY, 'O');
                    $part2++;
                    break;
                }

                $seen[self::encodeCoordinates($grid, $x, $y)][$direction->value] = true;
            } while ($grid->isWithinBounds($x, $y));
        }

        return CombinedPuzzleOutput::of(count($part1), $part2);
    }

    private static function encodeCoordinates(Grid $grid, int $x, int $y): int
    {
        return $y * $grid->getWidth() + $x;
    }

    private static function decodeCoordinates(Grid $grid, int $coordinates): Point
    {
        return new Point(
            $coordinates % $grid->getWidth(),
            floor($coordinates / $grid->getWidth())
        );
    }
}