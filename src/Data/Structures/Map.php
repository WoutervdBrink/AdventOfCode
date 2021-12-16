<?php

namespace Knevelina\AdventOfCode\Data\Structures;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\InputManipulator;

class Map
{
    private array $values;
    private int $width;
    private int $height;

    /**
     * Construct a new map.
     * @param array $rows
     */
    final public function __construct(array $rows)
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

    public static function fromInput(string $input): static
    {
        $rows = InputManipulator::splitLines(
            $input,
            manipulator: fn(string $line): array => array_map('intval', str_split($line))
        );

        return new static($rows);
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

    public function getNeighbors(int $x, int $y, bool $includeDiagonals = true): array
    {
        return array_filter(
            [
                ...($includeDiagonals ? [
                    $this->getValue($x - 1, $y - 1),
                    $this->getValue($x - 1, $y + 1),
                    $this->getValue($x + 1, $y - 1),
                    $this->getValue($x + 1, $y + 1)
                ] : []),
                $this->getValue($x, $y - 1),
                $this->getValue($x, $y + 1),
                $this->getValue($x - 1, $y),
                $this->getValue($x + 1, $y),
            ],
            fn(?int $value): bool => !is_null($value)
        );
    }
}