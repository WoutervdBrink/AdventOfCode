<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day06 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $races = self::parse($input);
        $solution = 1;

        foreach ($races as $race) {
            $solution *= self::solve($race->time, $race->distance);
        }

        return $solution;
    }

    /**
     * @param string $input
     * @return array<object{"time": int, "distance": int}>
     */
    private static function parse(string $input): array
    {
        $data = InputManipulator::splitLines($input, manipulator: function (string $line): array {
            preg_match_all('/(\d+)/', $line, $matches);

            return array_map('intval', $matches[1]);
        });

        if (count($data) !== 2) {
            throw new InvalidArgumentException('Input does not have expected amount of rows');
        }

        if (count($data[0]) !== count($data[1])) {
            throw new InvalidArgumentException('Input does not have expected amount of columns');
        }

        $result = [];

        for ($i = 0; $i < count($data[0]); $i++) {
            $result[] = (object)['time' => $data[0][$i], 'distance' => $data[1][$i],];
        }

        return $result;
    }

    private static function solve(int $time, int $distance): int
    {
        /*
         * Consider a race where you spend x ms pressing the button. The distance the car makes is then:
         *     x * (time - x)
         * If you subtract the target distance from this formula, then the race is won iff the resulting value is > 0:
         *     x * (time - x) - target > 0 -->> race is won
         * We can turn this equation into a quadratic formula:
         *     -target + time * x - x^2 > 0
         *     -x^2 + time * x - target > 0
         *     x^2 - time * x + target
         * The input of a race is integer, so the solution is the amount of integers between the roots.
         */

        $discriminant = ($time * $time) - 4 * $distance;

        $root1 = ($time + sqrt($discriminant)) / 2;
        $root2 = ($time - sqrt($discriminant)) / 2;

        return (int)-(floor($root2) - ceil($root1) + 1);
    }

    public function part2(string $input): int
    {
        $input = explode("\n", $input, 2);

        $targetTime = intval(filter_var($input[0], FILTER_SANITIZE_NUMBER_INT));
        $targetDistance = intval(filter_var($input[1], FILTER_SANITIZE_NUMBER_INT));

        return self::solve($targetTime, $targetDistance);
    }
}