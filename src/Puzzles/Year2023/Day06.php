<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;

class Day06 implements PuzzleSolver
{
    public function part1(string $input): int
    {
        $races = self::parse($input);
        $solution = 1;

        foreach ($races as $race) {
            $wins = 0;

            for ($speed = 1; $speed < $race->time; $speed++) {
                $distance = $speed * ($race->time - $speed);

                if ($distance > $race->distance) {
                    $wins++;
                }
            }

            $solution *= $wins;
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
            throw new \InvalidArgumentException('Input does not have expected amount of rows');
        }

        if (count($data[0]) !== count($data[1])) {
            throw new \InvalidArgumentException('Input does not have expected amount of columns');
        }

        $result = [];

        for ($i = 0; $i < count($data[0]); $i++) {
            $result[] = (object)[
                'time' => $data[0][$i],
                'distance' => $data[1][$i],
            ];
        }

        return $result;
    }

    public function part2(string $input): int
    {
        $races = self::parse($input);

        $targetTime = '';
        $targetDistance = '';

        foreach ($races as $race) {
            $targetTime .= $race->time;
            $targetDistance .= $race->distance;
        }

        $targetTime = intval($targetTime);
        $targetDistance = intval($targetDistance);

        $wins = 0;

        for ($speed = 1; $speed < $targetTime; $speed++) {
            $distance = $speed * ($targetTime - $speed);

            if ($distance > $targetDistance) {
                $wins++;
            }
        }

        return $wins;
    }
}