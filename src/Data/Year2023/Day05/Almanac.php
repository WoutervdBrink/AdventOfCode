<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day05;

use InvalidArgumentException;
use Knevelina\AdventOfCode\InputManipulator;
use RuntimeException;

final class Almanac
{
    const MAPS = ['seed-to-soil', 'soil-to-fertilizer', 'fertilizer-to-water', 'water-to-light', 'light-to-temperature', 'temperature-to-humidity', 'humidity-to-location'];

    /**
     * @var array<int>
     */
    private array $seeds;

    /**
     * @var array<array{int, int}>
     */
    private array $seedRanges;

    /**
     * @var array<string, Map>
     */
    private array $mappings;

    private function __construct()
    {
        $this->mappings = [];
    }

    public static function fromSpecification(string $input): Almanac
    {
        $almanac = new Almanac;

        $input = InputManipulator::splitLines($input);

        if (! preg_match('/^seeds: ((\d+ ?)+)$/', array_shift($input), $matches)) {
            throw new InvalidArgumentException('Could not find seeds in input specification');
        }

        $almanac->seeds = array_map('intval', explode(' ', $matches[1]));

        if (count($almanac->seeds) % 2 !== 0) {
            throw new InvalidArgumentException('Odd amount of seeds should not be possible for part 2');
        }

        $ranges = [];

        for ($i = 0; $i < count($almanac->seeds) / 2; $i++) {
            $ranges[] = [$almanac->seeds[$i * 2], $almanac->seeds[$i * 2 + 1]];
        }

        $almanac->seedRanges = $ranges;

        $key = null;
        $mapping = null;

        while (! is_null($line = array_shift($input))) {
            if (preg_match('/^([a-z]+-to-[a-z]+) map:$/', $line, $matches)) {
                if (! is_null($key) && ! is_null($mapping)) {
                    $almanac->addMap($key, $mapping);
                }

                $key = $matches[1];
                $mapping = new Map;
            } elseif (preg_match('/^(\d+) (\d+) (\d+)$/', $line, $matches)) {
                if (is_null($key) || is_null($mapping)) {
                    throw new RuntimeException('Tried to add data when no mapping identifier was present yet');
                }

                $mapping->add(intval($matches[1]), intval($matches[2]), intval($matches[3]));
            }
        }

        if (! is_null($key) && ! is_null($mapping)) {
            $almanac->addMap($key, $mapping);
        }

        return $almanac;
    }

    private function addMap(string $key, Map $mapping): void
    {
        if (isset($this->mappings[$key])) {
            throw new InvalidArgumentException(sprintf('Mapping "%s" is already registered', $key));
        }

        $this->mappings[$key] = $mapping;
    }

    public function getMinLocationForSeedRanges(): int
    {
        return min(array_map(fn (array $range): int => $this->getMinLocationForSeedRange($range[0], $range[0] + $range[1]), $this->seedRanges));
    }

    private function getMinLocationForSeedRange(int $start, int $end): int
    {
        $cursor = [[$start, $end]];

        foreach (self::MAPS as $key) {
            $map = $this->getMap($key);
            $cursor = $map->getRanges($cursor);
        }

        return min(array_map(fn (array $range): int => $range[0], $cursor));
    }

    public function getMap(string $key): Map
    {
        if (! isset($this->mappings[$key])) {
            throw new InvalidArgumentException(sprintf('Mapping "%s" is not registered', $key));
        }

        return $this->mappings[$key];
    }

    public function getMinLocationForSeeds(): int
    {
        return min(array_map(fn (int $seed): int => $this->getLocationForSeed($seed), $this->seeds));
    }

    private function getLocationForSeed(int $seed): int
    {
        $cursor = $seed;

        foreach (self::MAPS as $key) {
            $map = $this->getMap($key);
            $cursor = $map->get($cursor);
        }

        return $cursor;
    }
}
