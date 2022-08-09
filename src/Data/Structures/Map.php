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

    public static function emptyFromDimensions(int $width, int $height): static
    {
        return new static(
            array_fill(
                0,
                $height,
                array_fill(0, $width, 0),
            )
        );
    }

    public function setValue(int $x, int $y, int $value): void
    {
        $index = $this->encodeCoordinates($x, $y);

        if (is_null($index)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Coordinates %d, %d out of bounds (map size %d by %d)',
                    $x,
                    $y,
                    $this->getWidth(),
                    $this->getHeight()
                )
            );
        }

        $this->values[$index] = $value;
    }

    #[Pure] protected function encodeCoordinates(int $x, int $y): ?int
    {
        if (!$this->isWithinBounds($x, $y)) {
            return null;
        }

        return $y * $this->getWidth() + $x;
    }

    #[Pure] public function isWithinBounds(int $x, int $y): bool
    {
        return !($x < 0 || $x >= $this->getWidth() || $y < 0 || $y >= $this->getHeight());
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

    #[Pure] public function getValue(int $x, int $y): ?int
    {
        $index = $this->encodeCoordinates($x, $y);

        if (is_null($index)) {
            return null;
        }

        return $this->values[$index];
    }

    public function clone(): static
    {
        return new static(
            array_map(
                fn(int $y): array => array_slice($this->values, $y * $this->getWidth(), $this->getWidth()),
                range(0, $this->getHeight() - 1)
            )
        );
    }

    public function __toString(): string
    {
        $str = '';

        for ($y = 0; $y < $this->getHeight(); $y++) {
            for ($x = 0; $x < $this->getWidth(); $x++) {
                $str .= $this->getValue($x, $y);
            }
            $str .= PHP_EOL;
        }

        return $str;
    }
}