<?php

namespace Knevelina\AdventOfCode\Data\Year2021;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\Data\Structures\Point;
use Knevelina\AdventOfCode\InputManipulator;

class Heightmap
{
    private array $values;
    private int $width;
    private int $height;

    /**
     * Construct a new height map.
     * @param array $rows
     */
    public function __construct(array $rows)
    {
        $height = count($rows);

        if ($height === 0) {
            throw new InvalidArgumentException('The supplied height map is empty.');
        }

        $width = count($rows[0]);

        $values = [];

        foreach ($rows as $y => $row) {
            if (count($row) !== $width) {
                throw new InvalidArgumentException(
                    sprintf('Invalid row width at row %d: expected %d cells, but got %d cells', $y, $width, count($row))
                );
            }
            $values = array_merge($values, $row);
        }

        $this->width = $width;
        $this->height = $height;
        $this->values = $values;
    }

    public static function fromInput(string $input): Heightmap
    {
        $rows = InputManipulator::splitLines(
            $input,
            manipulator: fn(string $line): array => array_map('intval', str_split($line))
        );

        return new self($rows);
    }

    public function getBasin(int $x, int $y): array
    {
        $queue = [new Point($x, $y)];
        $visited = [];
        $basin = [];

        while (count($queue)) {
            $cursor = array_shift($queue);

            if (isset($visited[$cursor->hash()])) {
                continue;
            }

            $value = $this->getValue($cursor->getX(), $cursor->getY());

            $visited[$cursor->hash()] = true;

            if ($value === null || $value === 9) {
                continue;
            }

            $basin[] = $value;

            $neighbors = $cursor->getNeighbors(false);

            foreach ($neighbors as $neighbor) {
                if (!isset($visited[$neighbor->hash()])) {
                    $queue[] = $neighbor;
                }
            }
        }

        return $basin;
    }

    #[Pure] public function getValue(int $x, int $y): ?int
    {
        $index = $this->encodeCoordinates($x, $y);

        if (is_null($index)) {
            return null;
        }

        return $this->values[$index];
    }

    #[Pure] private function encodeCoordinates(int $x, int $y): ?int
    {
        if ($x < 0 || $x >= $this->getWidth() || $y < 0 || $y >= $this->getHeight()) {
            return null;
        }

        return $y * $this->getWidth() + $x;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return LowPoint[]
     */
    public function getLowPoints(): array
    {
        $lowPoints = [];

        for ($y = 0; $y < $this->getHeight(); $y++) {
            for ($x = 0; $x < $this->getWidth(); $x++) {
                $neighbors = $this->getNeighbors($x, $y);
                $value = $this->getValue($x, $y);

                if (min($neighbors) > $value) {
                    $lowPoints[] = new LowPoint($x, $y, $value);
                }
            }
        }

        return $lowPoints;
    }

    public function getNeighbors(int $x, int $y): array
    {
        return array_filter(
            [
                $this->getValue($x, $y - 1),
                $this->getValue($x, $y + 1),
                $this->getValue($x - 1, $y),
                $this->getValue($x + 1, $y),
            ],
            fn(?int $value): bool => !is_null($value)
        );
    }
}