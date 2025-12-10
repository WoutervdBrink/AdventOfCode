<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2015;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Set;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day13 implements PuzzleSolver
{
    private static function parseInput($input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): object {
            if (! preg_match(
                '/([A-Za-z]+) would (gain|lose) (\d+) happiness units by sitting next to ([A-Za-z]+)./',
                $line,
                $matches
            )) {
                throw new RuntimeException(sprintf('Invalid arrangement specification "%s"', $line));
            }

            return (object) [
                'person' => $matches[1],
                'points' => ($matches[2] === 'gain' ? 1 : -1) * intval($matches[3]),
                'other' => $matches[4],
            ];
        });
    }

    private static function calculate(Set $names, array $input): int
    {
        $people = [];

        foreach ($input as $spec) {
            $person = $spec->person;
            if (! isset($people[$person])) {
                $people[$person] = [];
            }
            $people[$person][$spec->other] = $spec->points;
        }

        $maxHappiness = 0;

        foreach ($names->permutations() as $permutation) {
            $happiness = 0;

            for ($i = 0; $i < count($permutation); $i++) {
                $me = $permutation[$i];

                $prevNeighborIndex = ($i - 1) % count($permutation);
                if ($prevNeighborIndex < 0) {
                    $prevNeighborIndex += count($permutation);
                }

                $nextNeighborIndex = ($i + 1) % count($permutation);

                $prevNeighbor = $permutation[$prevNeighborIndex];
                $nextNeighbor = $permutation[$nextNeighborIndex];

                $happiness += $people[$me][$prevNeighbor];
                $happiness += $people[$me][$nextNeighbor];
            }

            $maxHappiness = max($maxHappiness, $happiness);
        }

        return $maxHappiness;
    }

    #[Override]
    public function part1(string $input): int
    {
        $input = self::parseInput($input);

        $names = new Set(...array_map(fn (object $spec): string => $spec->person, $input));

        return self::calculate($names, $input);
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = self::parseInput($input);

        $names = new Set('me', ...array_map(fn (object $spec): string => $spec->person, $input));

        foreach ($names->getValues() as $name) {
            $input[] = (object) [
                'person' => 'me',
                'points' => 0,
                'other' => $name,
            ];

            $input[] = (object) [
                'person' => $name,
                'points' => 0,
                'other' => 'me',
            ];
        }

        return self::calculate($names, $input);
    }
}
