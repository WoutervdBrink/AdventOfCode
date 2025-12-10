<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

use function Knevelina\AdventOfCode\Util\Math\sign;

class Day14 implements PuzzleSolver
{
    private static function parseInput(string $input): object
    {
        $minX = INF;
        $maxX = -INF;
        $minY = INF;
        $maxY = -INF;

        $obstacles = InputManipulator::splitLines($input);
        $positions = [];

        foreach ($obstacles as $obstacle) {
            /** @var array<object> $coords */
            $coords = array_map(function (string $coord): object {
                $coord = explode(',', $coord, 2);

                return (object) [
                    'x' => intval($coord[0]),
                    'y' => intval($coord[1]),
                ];
            }, explode(' -> ', $obstacle));

            $pos = array_shift($coords);
            $positions[] = clone $pos;

            $minX = min($minX, $pos->x);
            $minY = min($minY, $pos->y);
            $maxX = max($maxX, $pos->x);
            $maxY = max($maxY, $pos->y);

            foreach ($coords as $coord) {
                $dx = abs($coord->x - $pos->x);
                $sx = sign($coord->x - $pos->x); // 300->400 --> 1, 400->300 --> -1

                $dy = abs($coord->y - $pos->y);
                $sy = sign($coord->y - $pos->y);

                assert($dx > 0 || $dy > 0);
                assert($sx > 0 || $sy > 0);

                if ($dx > 0) {
                    for ($i = 0; $i < $dx; $i++) {
                        $pos->x += $sx;
                        $positions[] = clone $pos;
                        $minX = min($minX, $pos->x);
                        $minY = min($minY, $pos->y);
                        $maxX = max($maxX, $pos->x);
                        $maxY = max($maxY, $pos->y);
                    }
                } elseif ($dy > 0) {
                    for ($i = 0; $i < $dy; $i++) {
                        $pos->y += $sy;
                        $positions[] = clone $pos;
                        $minX = min($minX, $pos->x);
                        $minY = min($minY, $pos->y);
                        $maxX = max($maxX, $pos->x);
                        $maxY = max($maxY, $pos->y);
                    }
                }
            }
        }

        $grid = Grid::emptyFromDimensions($maxX * 2, $maxY + 2);

        foreach ($positions as $position) {
            $grid->setValue($position->x, $position->y, 1);
        }

        return (object) compact('grid', 'minX', 'minY', 'maxX', 'maxY');
    }

    #[Override]
    public function part1(string $input): int
    {
        $input = self::parseInput($input);

        /** @var Grid $grid */
        $grid = $input->grid;

        $grains = 0;

        while (true) {
            $sand = (object) ['x' => 500, 'y' => 0];

            while (true) {
                if ($sand->y > $input->maxY) {
                    return $grains;
                }

                if ($grid->getValue($sand->x, $sand->y + 1) !== 1) {
                    $sand->y += 1;

                    continue;
                } elseif ($grid->getValue($sand->x - 1, $sand->y + 1) !== 1) {
                    $sand->x -= 1;
                    $sand->y += 1;

                    continue;
                } elseif ($grid->getValue($sand->x + 1, $sand->y + 1) !== 1) {
                    $sand->x += 1;
                    $sand->y += 1;

                    continue;
                }

                $grid->setValue($sand->x, $sand->y, 1);
                $grains++;
                break;
            }
        }
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = self::parseInput($input);

        /** @var Grid $grid */
        $grid = $input->grid;

        $grains = 0;

        while ($grid->getValue(500, 0) !== 1) {
            $sand = (object) ['x' => 500, 'y' => 0];

            while (true) {
                if ($sand->y > $input->maxY) {
                    break;
                }

                if ($grid->getValue($sand->x, $sand->y + 1) !== 1) {
                    $sand->y += 1;

                    continue;
                } elseif ($grid->getValue($sand->x - 1, $sand->y + 1) !== 1) {
                    $sand->x -= 1;
                    $sand->y += 1;

                    continue;
                } elseif ($grid->getValue($sand->x + 1, $sand->y + 1) !== 1) {
                    $sand->x += 1;
                    $sand->y += 1;

                    continue;
                }

                break;
            }

            $grid->setValue($sand->x, $sand->y, 1);
            $grains++;
        }

        return $grains;
    }
}
