<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\Seat;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Seat::class)]
class SeatTest extends TestCase
{
    /**
     * @return array[]
     */
    public static function seats(): array
    {
        return [
            // spec, row, column, id
            ['FBFBBFFRLR', 44, 5, 357],
            ['BFFFBBFRRR', 70, 7, 567],
            ['FFFBBBFRRR', 14, 7, 119],
            ['BBFFBBFRLL', 102, 4, 820],
        ];
    }

    #[Test]
    #[DataProvider('seats')]
    public function it_parses_a_seat(string $specification, int $row, int $column, int $id): void
    {
        $seat = Seat::fromSpecification($specification);

        self::assertEquals($row, $seat->getRow());
        self::assertEquals($column, $seat->getColumn());
        self::assertEquals($id, $seat->getId());
    }
}
