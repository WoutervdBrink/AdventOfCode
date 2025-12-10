<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use InvalidArgumentException;
use Knevelina\AdventOfCode\CombinedPuzzleOutput;
use Knevelina\AdventOfCode\Contracts\CombinedPuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\UnionFind;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

use function intval;
use function preg_match;

class Day08 extends CombinedPuzzleSolver
{
    #[Override]
    protected function solve(string $input): CombinedPuzzleOutput
    {
        /** @var array{0: int, 1: int, 2: int}[] $boxes */
        $boxes = InputManipulator::splitLines($input, manipulator: function (string $line): array {
            if (! preg_match('/^(\d+),(\d+),(\d+)$/', $line, $matches)) {
                throw new InvalidArgumentException('Invalid box definition '.$line);
            }

            return [intval($matches[1]), intval($matches[2]), intval($matches[3])];
        });

        $union = new UnionFind(count($boxes));
        $limit = count($boxes) === 20 ? 10 : 1000;

        /** @var array{0: int, 1: int, 2: int}[] $distances */
        $distances = [];
        for ($i = 0; $i < count($boxes); $i++) {
            for ($j = $i + 1; $j < count($boxes); $j++) {
                $distance = (($boxes[$i][0] - $boxes[$j][0]) ** 2 +
            ($boxes[$i][1] - $boxes[$j][1]) ** 2 +
            ($boxes[$i][2] - $boxes[$j][2]) ** 2);

                $distances[] = [$i, $j, $distance];
            }
        }

        usort($distances, function ($a, $b) {
            return $a[2] <=> $b[2];
        });

        $part1 = 0;
        /** @var array{0: int, 1: int} $last */
        $last = [0, 0];

        for ($c = 0; $c < count($distances); $c++) {
            if ($c === $limit) {
                /** @var array<int, int> $sizes */
                $sizes = [];

                for ($i = 0; $i < count($boxes); $i++) {
                    $parent = $union->find($i);
                    if (! isset($sizes[$parent])) {
                        $sizes[$parent] = 0;
                    }
                    $sizes[$parent]++;
                }

                rsort($sizes);

                $part1 = $sizes[0] * $sizes[1] * $sizes[2];
            }

            $dist = $distances[$c];

            if ($union->find($dist[0]) !== $union->find($dist[1])) {
                $union->unite($dist[0], $dist[1]);
                $last = [$dist[0], $dist[1]];
            }
        }

        $part2 = $boxes[$last[0]][0] * $boxes[$last[1]][0];

        return CombinedPuzzleOutput::of($part1, $part2);
    }
}
