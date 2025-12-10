<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day05;

use InvalidArgumentException;

class Map
{
    /** @var array<object{"destination": int, "source": int, "length": int}>
     */
    private array $mapping;

    public function add(int $destination, int $source, int $length): void
    {
        if ($length < 1) {
            throw new InvalidArgumentException(sprintf('Invalid mapping length %d', $length));
        }

        $this->mapping[] = (object) ['destination' => $destination, 'source' => $source, 'length' => $length];
    }

    public function get(int $index)
    {
        foreach ($this->mapping as $mapping) {
            $start = $mapping->source;
            $end = $start + $mapping->length;

            if ($index >= $start && $index <= $end) {
                $offset = ($index - $start);

                return $mapping->destination + $offset;
            }
        }

        return $index;
    }

    public function getRanges(array $ranges): array
    {
        $result = [];

        foreach ($this->mapping as $mapping) {
            $source = $mapping->source;
            $end = $source + $mapping->length;
            $destination = $mapping->destination;

            $nextRanges = [];

            foreach ($ranges as $range) {
                [$from, $to] = $range;

                // The numbers between the start of the range, up to the start of the map, never including the map
                // Not interesting now, but other maps might map these values
                $before = [$from, min($to, $source)];

                // The numbers that overlap between the range and the map
                // In other words: the number that are 'hit' by this map
                $overlap = [max($from, $source), min($end, $to)];

                // The numbers from the end of the map up to the range, never including the map
                // Not interesting now, but other maps might map these values
                $after = [max($end, $from), $to];

                if ($before[1] > $before[0]) {
                    $nextRanges[] = $before;
                }

                if ($overlap[1] > $overlap[0]) {
                    $result[] = [$overlap[0] - $source + $destination, $overlap[1] - $source + $destination];
                }

                if ($after[1] > $after[0]) {
                    $nextRanges[] = $after;
                }
            }

            $ranges = $nextRanges;
        }

        return array_merge($result, $nextRanges);
    }
}
