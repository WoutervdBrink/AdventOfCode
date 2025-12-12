<?php

namespace Knevelina\AdventOfCode\Data\Year2025\Day12;

use InvalidArgumentException;

readonly class Present
{
    public int $width;

    public int $height;

    public int $area;

    public int $occupied;

    /**
     * Construct a new present.
     *
     * @param  string[]  $lines  The present's contents, line by line, e.g. <code>['###', '##.', '##.']</code>.
     */
    public function __construct(array $lines)
    {
        $this->width = strlen($lines[0]);
        $this->height = count($lines);
        $occupied = 0;

        foreach ($lines as $line) {
            if (strlen($line) !== $this->width) {
                throw new InvalidArgumentException('Invalid present: '.implode('/', $lines).' is not square.');
            }

            $occupied += strlen(str_replace('.', '', $line));
        }

        $this->occupied = $occupied;
        $this->area = $this->width * $this->height;
    }
}
