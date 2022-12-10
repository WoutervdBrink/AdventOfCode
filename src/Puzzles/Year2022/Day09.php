<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Direction;
use Knevelina\AdventOfCode\Data\Structures\SizedDirection;
use Knevelina\AdventOfCode\InputManipulator;

use function Knevelina\Util\Math\sign;

class Day09 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        return self::solve($input, 1);
    }

    private static function solve(string $input, int $index): int
    {
        $instructions = self::parseInput($input);

        $rope = [];

        for ($i = 0; $i < 10; $i++) {
            $rope[] = (object)[
                'x' => 0,
                'y' => 0,
                'visited' => ['0_0']
            ];
        }

        foreach ($instructions as $instruction) {
            $direction = $instruction->getDirection();

            $horizontal = $direction->getHorizontalMovement();
            $vertical = $direction->getVerticalMovement();

            for ($l = 0; $l < $instruction->getLength(); $l++) {
                $rope[0]->x += $horizontal;
                $rope[0]->y += $vertical;
                $rope[0]->visited[self::getVisitorKey($rope[0])] = true;

                for ($i = 1; $i < 10; $i++) {
                    $dx = $rope[$i - 1]->x - $rope[$i]->x;
                    $dy = $rope[$i - 1]->y - $rope[$i]->y;

                    if (abs($dx) <= 1 && abs($dy) <= 1) {
                        break;
                    }

                    $rope[$i]->x += sign($dx);
                    $rope[$i]->y += sign($dy);

                    $rope[$i]->visited[self::getVisitorKey($rope[$i])] = true;
                }
            }
        }

        return count($rope[$index]->visited);
    }

    /**
     * @param string $input
     * @return array<SizedDirection>
     */
    protected static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): object {
            if (!preg_match('/^([UDLR]) (\d+)$/', $line, $matches)) {
                throw new \RuntimeException(sprintf('Invalid movement instruction "%s"', $line));
            }

            return new SizedDirection(Direction::fromLetter($matches[1]), intval($matches[2]));
        });
    }

    private static function getVisitorKey(object $ropePart): string
    {
        return sprintf('%d_%d', $ropePart->x, $ropePart->y);
    }

    public function part2(string $input): int
    {
        return self::solve($input, 9);
    }
}