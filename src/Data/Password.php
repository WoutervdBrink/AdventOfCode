<?php


namespace Knevelina\AdventOfCode\Data;

use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

#[Immutable]
class Password
{
    private int $min;
    private int $max;
    private string $letter;
    private string $password;

    public static function fromSpecification(string $specification): Password
    {
        preg_match('/^([0-9]+)-([0-9]+) ([a-z]): ([a-z]+)$/', $specification, $match);

        return new static(intval($match[1]), intval($match[2]), $match[3], $match[4]);
    }

    /**
     * Create a new password.
     *
     * @param int $min
     * @param int $max
     * @param string $letter
     * @param string $password
     */
    public final function __construct(int $min, int $max, string $letter, string $password)
    {
        $this->min = $min;
        $this->max = $max;
        $this->letter = $letter;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @return string
     */
    public function getLetter(): string
    {
        return $this->letter;
    }

    /**
     * @param int $position
     * @return string
     */
    #[Pure] public function getCharacterAt(int $position): string
    {
        return substr($this->password, $position - 1, 1);
    }

    public function getCharacterOccurrence(): int
    {
        return
            strlen($this->password) -
            strlen(str_replace($this->letter, '', $this->password)
            );
    }
}