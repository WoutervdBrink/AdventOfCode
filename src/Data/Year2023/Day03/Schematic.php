<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day03;

use Knevelina\AdventOfCode\Data\Structures\Grid\Entry;
use Knevelina\AdventOfCode\Data\Structures\Grid\Grid;

final class Schematic
{
    private readonly Grid $grid;

    private readonly array $parts;

    private readonly array $gears;

    private function __construct(Grid $grid)
    {
        $this->grid = $grid;

        $parts = [];

        for ($y = 0; $y < $this->grid->getHeight(); $y++) {
            for ($x = 0; $x < $this->grid->getWidth(); $x++) {
                $value = $grid->getValue($x, $y);

                if (ctype_digit($value)) {
                    $partNumber = $value;
                    $partX = $x;

                    while (ctype_digit($value = $grid->getValue(++$x, $y, '.'))) {
                        $partNumber .= $value;
                    }

                    $parts[] = new Part($partX, $y, $partNumber);
                }
            }
        }

        /** @var array<Gear> $gears */
        $gears = [];

        $this->parts = array_filter($parts, function (Part $part) use (&$gears): bool {
            $symbols = array_filter($this->grid->getSlice($part->x - 1, $part->y - 1, $part->x + strlen($part->partNumber), $part->y + 1), fn(Entry $entry): bool => !ctype_digit($entry->getValue()) && $entry->getValue() !== '.');

            /** @var Entry $symbol */
            foreach ($symbols as $symbol) {
                if ($symbol->getValue() === '*') {
                    $key = $symbol->getX() . '_' . $symbol->getY();
                    if (!isset($gears[$key])) {
                        $gears[$key] = new Gear($symbol->getX(), $symbol->getY());
                    }
                    $gears[$key]->addPart($part);
                }
            }

            return count($symbols) > 0;
        });

        $this->gears = $gears;
    }

    public static function fromInput(string $input): Schematic
    {
        return new Schematic(Grid::fromInput($input, fn($cell) => $cell));
    }

    /**
     * @return array<Part>
     */
    public function getParts(): array
    {
        return $this->parts;
    }

    /**
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return $this->grid;
    }

    public function getSumOfPartNumbers(): int
    {
        return array_sum(array_map(fn(Part $part): int => $part->partNumber, $this->parts));
    }

    public function getSumOfGearRatios(): int
    {
        return array_sum(array_map(fn(Gear $gear): int => $gear->getRatio(), $this->gears));
    }
}