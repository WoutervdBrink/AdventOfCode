<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Knevelina\AdventOfCode\Data\Year2020\WaitingArea
 */
class WaitingAreaTest extends TestCase
{
    /**
     * @test
     * @dataProvider areas
     * @param string $area
     * @param int $row
     * @param int $col
     * @param int $occupied
     */
    function it_counts_seats_in_line_of_sight(string $area, int $row, int $col, int $occupied): void
    {
        $area = WaitingArea::fromSpecification($area);

        $this->assertEquals($occupied, $area->getOccupiedNeighborsInLinesOfSight($row, $col));
    }

    public function areas(): array
    {
        return [
            ['.......#.
...#.....
.#.......
.........
..#L....#
....#....
.........
#........
...#.....', 4, 3, 8],
            ['.............
.L.L.#.#.#.#.
.............', 1, 1, 0],
            ['.##.##.
#.#.#.#
##...##
...L...
##...##
#.#.#.#
.##.##.', 3, 3, 0],
            ['#.##.##.##
#######.##
#.#.#..#..
####.##.##
#.##.##.##
#.#####.##
..#.#.....
##########
#.######.#
#.#####.##', 0, 2, 5]
        ];
    }
}
