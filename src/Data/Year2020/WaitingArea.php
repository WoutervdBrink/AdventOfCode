<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\InputManipulator;

class WaitingArea
{
    const FLOOR = 0;

    const EMPTY = 1;

    const OCCUPIED = 2;

    private array $seats;

    private int $width;

    private int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;

        for ($row = 0; $row < $height; $row++) {
            $this->seats[$row] = [];

            for ($col = 0; $col < $width; $col++) {
                $this->seats[$row][$col] = static::FLOOR;
            }
        }
    }

    public static function fromSpecification(string $specification): WaitingArea
    {
        $specification = InputManipulator::splitLines($specification);

        $width = strlen($specification[0] ?? '');
        $height = count($specification);

        if ($width === 0 || $height === 0) {
            throw new InvalidArgumentException(sprintf('Invalid waiting area dimensions %dx%d', $width, $height));
        }

        $area = new WaitingArea($width, $height);

        foreach ($specification as $row => $cols) {
            $cols = str_split($cols);

            foreach ($cols as $col => $seat) {
                $area->setSeat($row, $col, self::charToSeat($seat));
            }
        }

        return $area;
    }

    public function setSeat(int $row, int $col, int $seat): void
    {
        if ($col < 0 || $col >= $this->width || $row < 0 || $row >= $this->height) {
            throw new InvalidArgumentException(sprintf('Invalid coordinates %d, %d', $col, $row));
        }

        $this->seats[$row][$col] = $seat;
    }

    #[Pure]
    public static function charToSeat(string $char): int
    {
        return match ($char) {
            '.' => self::FLOOR,
            'L' => self::EMPTY,
            '#' => self::OCCUPIED,
            default => throw new InvalidArgumentException(sprintf('Invalid seat character "%s"', $char))
        };
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getOccupiedSeats(): int
    {
        $sum = 0;

        for ($row = 0; $row < $this->height; $row++) {
            for ($col = 0; $col < $this->width; $col++) {
                if ($this->getSeat($row, $col) === self::OCCUPIED) {
                    $sum++;
                }
            }
        }

        return $sum;
    }

    public function getSeat(int $row, int $col): int
    {
        return $this->seats[$row][$col] ?? static::FLOOR;
    }

    public function step(): ?WaitingArea
    {
        $newArea = new WaitingArea($this->width, $this->height);
        $changed = false;

        for ($row = 0; $row < $this->height; $row++) {
            for ($col = 0; $col < $this->width; $col++) {
                $seat = $this->getSeat($row, $col);
                $occupiedNeighbors = $this->getOccupiedNeighbors($row, $col);

                $newSeat = match ($seat) {
                    self::FLOOR => self::FLOOR,
                    self::EMPTY => $occupiedNeighbors === 0 ? self::OCCUPIED : self::EMPTY,
                    self::OCCUPIED => $occupiedNeighbors >= 4 ? self::EMPTY : self::OCCUPIED,
                    default => 0
                };

                $changed = $changed || ($newSeat !== $seat);

                $newArea->setSeat($row, $col, $newSeat);
            }
        }

        return $changed ? $newArea : null;
    }

    public function getOccupiedNeighbors(int $row, int $col): int
    {
        $neighbors = 0;

        for ($drow = -1; $drow <= 1; $drow++) {
            for ($dcol = -1; $dcol <= 1; $dcol++) {
                if ($drow === 0 && $dcol === 0) {
                    continue;
                }

                if ($this->getSeat($row + $drow, $col + $dcol) === self::OCCUPIED) {
                    $neighbors++;
                }
            }
        }

        return $neighbors;
    }

    public function stepPart2()
    {
        $newArea = new WaitingArea($this->width, $this->height);
        $changed = false;

        for ($row = 0; $row < $this->height; $row++) {
            for ($col = 0; $col < $this->width; $col++) {
                $seat = $this->getSeat($row, $col);
                $occupiedNeighbors = $this->getOccupiedNeighborsInLinesOfSight($row, $col);

                $newSeat = match ($seat) {
                    self::FLOOR => self::FLOOR,
                    self::EMPTY => $occupiedNeighbors === 0 ? self::OCCUPIED : self::EMPTY,
                    self::OCCUPIED => $occupiedNeighbors >= 5 ? self::EMPTY : self::OCCUPIED,
                    default => 0
                };

                $changed = $changed || ($newSeat !== $seat);

                $newArea->setSeat($row, $col, $newSeat);
            }
        }

        return $changed ? $newArea : null;
    }

    public function getOccupiedNeighborsInLinesOfSight(int $row, int $col): int
    {
        $neighbors = 0;

        for ($drow = -1; $drow <= 1; $drow++) {
            for ($dcol = -1; $dcol <= 1; $dcol++) {
                if ($drow === 0 && $dcol === 0) {
                    continue;
                }

                if ($this->getSeatInLineOfSight($row, $col, $drow, $dcol) === self::OCCUPIED) {
                    $neighbors++;
                }
            }
        }

        return $neighbors;
    }

    public function getSeatInLineOfSight(int $row, int $col, int $drow, int $dcol): int
    {
        while ($row >= 0 && $row < $this->height && $col >= 0 && $col < $this->width) {
            $row += $drow;
            $col += $dcol;

            $seat = $this->getSeat($row, $col);

            if ($seat !== self::FLOOR) {
                return $seat;
            }
        }

        return self::FLOOR;
    }

    public function __toString(): string
    {
        return collect($this->seats)
            ->map(
                fn (array $row): string => collect($row)->map(
                    fn (int $seat): string => self::seatToChar($seat)
                )->join('')
            )
            ->join(PHP_EOL);
    }

    #[Pure]
    public static function seatToChar(int $seat): string
    {
        return match ($seat) {
            self::FLOOR => '.',
            self::EMPTY => 'L',
            self::OCCUPIED => '#',
            default => throw new InvalidArgumentException(sprintf('Invalid seat state %d', $seat))
        };
    }

    public function getSeats(): array
    {
        return $this->seats;
    }
}
