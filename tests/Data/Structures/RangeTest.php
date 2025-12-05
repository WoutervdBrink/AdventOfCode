<?php

namespace Knevelina\AdventOfCode\Tests\Data\Structures;

use Knevelina\AdventOfCode\Data\Structures\Range;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Range::class)]
class RangeTest extends TestCase
{
    /**
     * @return Range[][]
     */
    public static function ranges(): array
    {
        return [
            [Range::of(1, 1), Range::of(1, 1)],
            [Range::of(1, 1), Range::of(1, 3)],
            [Range::of(1, 1), Range::of(2, 2)],
            [Range::of(1, 5), Range::of(1, 1)],
            [Range::of(1, 3), Range::of(4, 6)],
            [Range::of(1, 3), Range::of(9, 13)],
            [Range::of(1, 5), Range::of(3, 10)],
        ];
    }

    /**
     * @param Range[] $ranges
     * @return void
     */
    #[Test]
    #[DataProvider('ranges')]
    public function it_merges_overlapping_ranges(Range... $ranges): void
    {
        $merged = Range::merge(...$ranges);

        foreach (range(-100, 100) as $i) {
            $acceptedByOriginal = Range::someAccept($i, ...$ranges);
            $acceptedByMerged = Range::someAccept($i, ...$merged);

            $this->assertEquals(
                $acceptedByOriginal,
                $acceptedByMerged,
                sprintf(
                    '%d %s accepted by original, but %s accepted by merged.',
                    $i,
                    $acceptedByOriginal ? 'was' : 'was not',
                    $acceptedByMerged ? 'was' : 'was not'
                )
            );
        }
    }
}