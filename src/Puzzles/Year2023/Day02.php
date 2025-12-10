<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2023;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day02 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $games = array_filter(self::parse($input), function (object $game): bool {
            foreach ($game->picks as $pick) {
                if ($pick->red > 12 || $pick->green > 13 || $pick->blue > 14) {
                    return false;
                }
            }

            return true;
        });

        return array_sum(array_map(fn (object $game): int => $game->id, $games));
    }

    private static function parse(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): object {
            if (! preg_match('/Game (\d+)/', $line, $matches)) {
                throw new InvalidArgumentException(sprintf('Could not find game ID in line "%s"', $line));
            }

            $id = $matches[1];

            $line = explode(';', $line);
            $picks = array_map(function (string $pick): object {
                $cursor = (object) ['red' => 0, 'green' => 0, 'blue' => 0];

                preg_match_all('/(\d+) (red|green|blue)/', $pick, $matches);

                foreach ($matches[2] as $i => $color) {
                    $cursor->{$color} = intval($matches[1][$i]);
                }

                return $cursor;
            }, $line);

            return (object) [
                'id' => $id,
                'picks' => $picks,
            ];
        });
    }

    #[Override]
    public function part2(string $input): int
    {
        return array_sum(array_map(function (object $game): int {
            $red = 0;
            $green = 0;
            $blue = 0;

            foreach ($game->picks as $pick) {
                $red = max($pick->red, $red);
                $green = max($pick->green, $green);
                $blue = max($pick->blue, $blue);

            }

            return $red * $green * $blue;
        }, self::parse($input)));
    }
}
