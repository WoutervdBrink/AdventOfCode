<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2025;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2025\Day12\Area;
use Knevelina\AdventOfCode\Data\Year2025\Day12\Present;
use Knevelina\AdventOfCode\InputManipulator;
use LogicException;
use Override;

class Day12 implements PuzzleSolver
{
    /**
     * @return object{presents: Present[], areas: Area[]}
     */
    private static function parse(string $input): object
    {
        $lines = InputManipulator::splitLines($input);

        $i = 0;

        $presents = [];
        $areas = [];

        while ($i < count($lines)) {
            $line = $lines[$i];

            if (preg_match('/^(\d+):$/', $line, $matches)) {
                $idx = intval($matches[1]);
                $presentLines = [];
                while (preg_match('/^[#.]+/', $lines[++$i], $matches)) {
                    $presentLines[] = $lines[$i];
                }
                $presents[$idx] = new Present($presentLines);

                continue;
            }

            if (preg_match('/^\d+x\d+: \d+( \d+)+/', $line)) {
                $areas[] = new Area($line);
            }

            $i++;
        }

        return (object) compact('presents', 'areas');
    }

    #[Override]
    public function part1(string $input): int
    {
        $puzzle = self::parse($input);
        $valid = 0;

        /** @var Area $area */
        foreach ($puzzle->areas as $idx => $area) {
            $lowerBound = 0;
            $upperBound = 0;

            for ($i = 0; $i < count($puzzle->presents); $i++) {
                if (isset($area->requirements[$i])) {
                    $upperBound += $area->requirements[$i] * $puzzle->presents[$i]->area;
                    $lowerBound += $area->requirements[$i] * $puzzle->presents[$i]->occupied;
                }
            }

            echo 'Area #'.$idx.': lower = '.$lowerBound.', upper = '.$upperBound.', area = '.$area->area.PHP_EOL;

            if ($area->area >= $upperBound) {
                // Strong accept: presents fit without packing.
                $valid++;

                continue;
            }

            if ($area->area < $lowerBound) {
                // Strong reject: presents will never fit.
                continue;
            }

            // No decision: must apply packing.
            // This never happens on actual puzzle input.
            throw new LogicException('Must apply packing for area '.$idx.', but this has not been implemented.');
        }

        return $valid;
    }

    #[Override]
    public function part2(string $input): int
    {
        // There is no part 2.
        return 0;
    }
}
