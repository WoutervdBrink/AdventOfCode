<?php

namespace Knevelina\AdventOfCode\Data\Year2020;

use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

#[Immutable]
class Password
{
    private int $min;

    private int $max;

    private string $letter;

    private string $password;

    /**
     * Create a new password.
     */
    final public function __construct(int $min, int $max, string $letter, string $password)
    {
        $this->min = $min;
        $this->max = $max;
        $this->letter = $letter;
        $this->password = $password;
    }

    public static function fromSpecification(string $specification): Password
    {
        preg_match('/^([0-9]+)-([0-9]+) ([a-z]): ([a-z]+)$/', $specification, $match);

        return new static(intval($match[1]), intval($match[2]), $match[3], $match[4]);
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getLetter(): string
    {
        return $this->letter;
    }

    #[Pure]
    public function getCharacterAt(int $position): string
    {
        return substr($this->password, $position - 1, 1);
    }

    public function getCharacterOccurrence(): int
    {
        return
            strlen($this->password) -
            strlen(
                str_replace($this->letter, '', $this->password)
            );
    }
}
