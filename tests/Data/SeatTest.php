<?php

namespace Knevelina\AdventOfCode\Tests\Data;

use Knevelina\AdventOfCode\Data\Seat;
use PHPUnit\Framework\TestCase;

class SeatTest extends TestCase
{
    /**
     * @return array[]
     */
    public function seats(): array
    {
        return [
            // spec, row, column, id
            ['FBFBBFFRLR', 44, 5, 357],
            ['BFFFBBFRRR', 70, 7, 567],
            ['FFFBBBFRRR', 14, 7, 119],
            ['BBFFBBFRLL', 102, 4, 820]
        ];
    }

    /**
     * @test
     * @dataProvider seats
     * @param string $specification
     * @param int $row
     * @param int $column
     * @param int $id
     */
    function it_parses_a_seat(string $specification, int $row, int $column, int $id): void
    {
        $seat = Seat::fromSpecification($specification);

        self::assertEquals($row, $seat->getRow());
        self::assertEquals($column, $seat->getColumn());
        self::assertEquals($id, $seat->getId());
    }
}
