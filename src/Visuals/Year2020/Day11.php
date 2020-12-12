<?php

namespace Knevelina\AdventOfCode\Visuals\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleVisualizer;
use Knevelina\AdventOfCode\Data\Year2020\WaitingArea;

class Day11 implements PuzzleVisualizer
{

    public function visualize(string $input, string $path): void
    {
        $area = WaitingArea::fromSpecification($input);

        $iterations = [$area];

        while ($new = $area->step()) {
            $iterations[] = $new;
            $area = $new;
        }

        $iterations = collect($iterations)
            ->map(fn (WaitingArea $area): array => $area->getSeats());

        $data = 'window.areaWidth = '.$area->getWidth().';'.PHP_EOL;
        $data .= 'window.areaHeight = '.$area->getHeight().';'.PHP_EOL;
        $data .= 'window.iterations = '.json_encode($iterations, JSON_PRETTY_PRINT).';';

        file_put_contents($path.'.js', $data);
    }
}