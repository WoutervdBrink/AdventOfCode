<?php

namespace Knevelina\AdventOfCode\Data\Structures;

readonly class Range
{
    protected function __construct(
        public int $start,
        public int $end,
    ) {}

    public function accepts(int $needle): bool
    {
        return $needle >= $this->start && $needle <= $this->end;
    }

    public static function someAccept(int $needle, Range ...$ranges): bool
    {
        foreach ($ranges as $range) {
            if ($range->accepts($needle)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Merge the given range(s), resulting in one or more ranges that cover the same values as every original range
     * would have done, but in an efficient matter: overlapping ranges are merged.
     *
     * @return Range[]
     */
    public static function merge(Range ...$ranges): array
    {
        if (empty($ranges)) {
            return [];
        }

        usort($ranges, function ($a, $b) {
            return $a->start <=> $b->start;
        });

        $cursor = array_shift($ranges);
        /** @var Range[] $result */
        $result = [];

        for ($i = 0; $i < count($ranges); $i++) {
            $next = $ranges[$i];
            // Overlap: next range starts before this one ends.
            // Cursor: [ ..........
            // Next:         [ ..........
            if ($next->start <= $cursor->end + 1) {
                $cursor = Range::of($cursor->start, max($cursor->end, $next->end));

                continue;
            }

            // Cover the case where the next range ends before this one ends. We can ignore it then.
            // Cursor: [ ......... ]
            // Next:      [ ... ]
            if ($next->end <= $cursor->end) {
                continue;
            }

            // No overlap: next range starts after this one ends.
            // Cursor: [ .......... ]
            // Next:                    [ .......... ]
            $result[] = $cursor;
            $cursor = $next;
        }

        // Append the dangling cursor, then return.
        $result[] = $cursor;

        return $result;
    }

    public function size(): int
    {
        return ($this->end - $this->start) + 1;
    }

    public static function of(int $start, int $end): static
    {
        return new static($start, $end);
    }

    public function __toString(): string
    {
        return sprintf('(%d-%d)', $this->start, $this->end);
    }
}
