<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\WaitingArea;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(WaitingArea::class)]
class WaitingAreaTest extends TestCase
{
    #[Test]
    #[DataProvider('areas')]
    public function it_counts_seats_in_line_of_sight(string $area, int $row, int $col, int $occupied): void
    {
        $area = WaitingArea::fromSpecification($area);

        $this->assertEquals($occupied, $area->getOccupiedNeighborsInLinesOfSight($row, $col));
    }

    public static function areas(): array
    {
        return [
            [
                '.......#.
...#.....
.#.......
.........
..#L....#
....#....
.........
#........
...#.....',
                4,
                3,
                8,
            ],
            [
                '.............
.L.L.#.#.#.#.
.............',
                1,
                1,
                0,
            ],
            [
                '.##.##.
#.#.#.#
##...##
...L...
##...##
#.#.#.#
.##.##.',
                3,
                3,
                0,
            ],
            [
                '#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##',
                0,
                2,
                5,
            ],
        ];
    }
}
