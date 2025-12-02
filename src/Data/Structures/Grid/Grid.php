<?php

namespace Knevelina\AdventOfCode\Data\Structures\Grid;

use InvalidArgumentException;
use Ds\Map;
use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\Data\Structures\Graph\Graph;
use Knevelina\AdventOfCode\Data\Structures\Graph\Vertex;
use Knevelina\AdventOfCode\Data\Structures\Point;
use Knevelina\AdventOfCode\InputManipulator;

class Grid
{
    /**
     * @var array<Entry> The grid's entries. Stored as a flat array, row by row.
     */
    private array $entries;

    /**
     * @var int The width of the grid.
     */
    private int $width;

    /**
     * @var int The height of the grid.
     */
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

        $entries = [];

        foreach ($rows as $y => $row) {
            if (count($row) !== $width) {
                throw new InvalidArgumentException(
                    sprintf('Invalid row width at row %d: expected %d cells, but got %d cells', $y, $width, count($row))
                );
            }

            foreach ($row as $x => $value) {
                $entries[] = new Entry($this, $x, $y, $value);
            }
        }

        $this->width = $width;
        $this->height = $height;
        $this->entries = $entries;
    }

    /**
     * @return Map<Point, Vertex>
     */
    public function toGraph(): Map
    {
        /** @var Map<Point, Vertex> $verticeMap */
        $verticeMap = new Map();

        $graph = new Graph();

        foreach ($this->getEntries() as $entry) {
            $x = $entry->getX();
            $y = $entry->getY();
            $value = $entry->getValue();
            $point = new Point($x, $y);
            $vertex = $graph->createVertex($point->getX() . '_' . $point->getY(), $value);
            $verticeMap->put($point, $vertex);
        }

        return $verticeMap;
    }

    public static function fromInput(string $input, ?callable $manipulator = null): static
    {
        $rows = InputManipulator::splitLines(
            $input,
            manipulator: fn(string $line): array => array_map($manipulator ?? 'intval', str_split($line))
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

    public function setValue(int $x, int $y, mixed $value): void
    {
        if ($value instanceof Entry) {
            echo 'ERROR ERROR';
        }
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

        $this->entries[$index]->setValue($value);
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

    /**
     * @param int $x
     * @param int $y
     * @param bool $includeDiagonals
     * @return list<Entry>
     */
    public function getNeighbors(int $x, int $y, bool $includeDiagonals = true): array
    {
        return array_values(array_filter(
            [
                ...($includeDiagonals ? [
                    $this->get($x - 1, $y - 1),
                    $this->get($x - 1, $y + 1),
                    $this->get($x + 1, $y - 1),
                    $this->get($x + 1, $y + 1)
                ] : []),
                $this->get($x, $y - 1),
                $this->get($x, $y + 1),
                $this->get($x - 1, $y),
                $this->get($x + 1, $y),
            ],
            fn(?Entry $value): bool => !is_null($value)
        ));
    }

    public function getNeighborValues(int $x, int $y, bool $includeDiagonals = true): array
    {
        return array_map(fn (Entry $entry): mixed => $entry->getValue(), $this->getNeighbors($x, $y, $includeDiagonals));
    }

    public function getSlice(int $x1, int $y1, int $x2, int $y2): array
    {
        if ($x1 > $x2 || $y1 > $y2) {
            throw new InvalidArgumentException(sprintf('Invalid coordinates (%d, %d) -- (%d, %d)', $x1, $y1, $x2, $y2));
        }

        $entries = [];

        for ($x = $x1; $x <= $x2; $x++) {
            for ($y = $y1; $y <= $y2; $y++) {
                $entry = $this->get($x, $y);

                if (!is_null($entry)) {
                    $entries[] = $entry;
                }
            }
        }

        return $entries;
    }

    public function getSliceValues(int $x1, int $y1, int $x2, int $y2): array
    {
        return array_map(fn (Entry $entry): mixed => $entry->getValue(), $this->getSlice($x1, $y1, $x2, $y2));
    }

    #[Pure] public function get(int $x, int $y): ?Entry
    {
        $index = $this->encodeCoordinates($x, $y);

        if (is_null($index)) {
            return null;
        }

        return $this->entries[$index];
    }

    #[Pure] public function getValue(int $x, int $y, mixed $default = null): mixed
    {
        return $this->get($x, $y)?->getValue() ?? $default;
    }

    public function getValues(): array
    {
        return array_map(fn (Entry $entry): mixed => $entry->getValue(), $this->entries);
    }

    /**
     * @return list<Entry>
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    public function getRowAndColumnValues(): array
    {
        return array_merge($this->getAllRowValues(), $this->getAllColumnValues());
    }

    public function getAllRowValues(): array
    {
        $rows = [];
        for ($y = 0; $y < $this->getHeight(); $y++) {
            $rows[] = $this->getRowValues($y);
        }
        return $rows;
    }

    /**
     * @param int $y
     * @return list<Entry>
     */
    public function getRow(int $y): array
    {
        $row = [];
        for ($x = 0; $x < $this->getWidth(); $x++) {
            $row[] = $this->entries[$this->encodeCoordinates($x, $y)];
        }
        return $row;
    }

    /**
     * @param int $x
     * @return list<Entry>
     */
    public function getColumn(int $x): array
    {
        $col = [];
        for ($y = 0; $y < $this->getHeight(); $y++) {
            $col[] = $this->entries[$this->encodeCoordinates($x, $y)];
        }
        return $col;
    }

    public function getRowValues(int $y): array
    {
        $row = [];
        for ($x = 0; $x < $this->getWidth(); $x++) {
            $row[] = $this->getValue($x, $y);
        }
        return $row;
    }

    public function getAllColumnValues(): array
    {
        $cols = [];
        for ($x = 0; $x < $this->getWidth(); $x++) {
            $cols[] = $this->getColumnValues($x);
        }
        return $cols;
    }

    public function getColumnValues(int $x): array
    {
        $column = [];
        for ($y = 0; $y < $this->getHeight(); $y++) {
            $column[] = $this->getValue($x, $y);
        }
        return $column;
    }

    public function clone(): static
    {
        return new static(
            array_map(
                fn(int $y): array => array_slice(array_map(fn (Entry $entry): mixed => $entry->getValue(), $this->entries), $y * $this->getWidth(), $this->getWidth()),
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