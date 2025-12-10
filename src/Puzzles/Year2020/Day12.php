<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\Direction;
use Knevelina\AdventOfCode\Data\Year2020\Ship;
use Knevelina\AdventOfCode\Data\Year2020\Waypoint;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day12 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $moves = InputManipulator::splitLines($input);

        $ship = new Ship;

        foreach ($moves as $move) {
            if (! preg_match('/^([NSEWLRF])(\d+)$/', $move, $matches)) {
                throw new InvalidArgumentException(sprintf('Invalid move "%s"', $move));
            }

            $action = $matches[1];
            $distance = intval($matches[2]);

            switch ($action) {
                case 'L':
                    $ship->turnLeft($distance);
                    break;
                case 'R':
                    $ship->turnRight($distance);
                    break;
                case 'F':
                    $ship->move($ship->getDirection(), $distance);
                    break;
                default:
                    $ship->move(Direction::getDirectionForMnemonic($action), $distance);
                    break;
            }
        }

        return abs($ship->getX()) + abs($ship->getY());
    }

    #[Override]
    public function part2(string $input): int
    {
        $moves = InputManipulator::splitLines($input);

        $ship = new Ship;
        $waypoint = new Waypoint;

        foreach ($moves as $move) {
            if (! preg_match('/^([NSEWLRF])(\d+)$/', $move, $matches)) {
                throw new InvalidArgumentException(sprintf('Invalid move "%s"', $move));
            }

            $action = $matches[1];
            $distance = intval($matches[2]);

            switch ($action) {
                case 'L':
                    $waypoint->rotateLeft($distance);
                    break;
                case 'R':
                    $waypoint->rotateRight($distance);
                    break;
                case 'F':
                    $ship->setX($ship->getX() + $waypoint->getX() * $distance);
                    $ship->setY($ship->getY() + $waypoint->getY() * $distance);
                    break;
                default:
                    $waypoint->move(Direction::getDirectionForMnemonic($action), $distance);
                    break;
            }
        }

        return abs($ship->getX()) + abs($ship->getY());
    }
}
