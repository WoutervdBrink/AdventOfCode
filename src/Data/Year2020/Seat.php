<?php


namespace Knevelina\AdventOfCode\Data\Year2020;

use JetBrains\PhpStorm\Immutable;
use JetBrains\PhpStorm\Pure;

#[Immutable]
class Seat
{
    /**
     * @param int $row
     * @param int $column
     */
    public function __construct(private int $row, private int $column)
    {
    }

    /**
     * @param string $specification
     * @return Seat
     */
    public static function fromSpecification(string $specification): Seat
    {
        $rowSpecification = substr($specification, 0, 7);
        $colSpecification = substr($specification, 7, 3);

        $rowSpecification = str_replace(['F', 'B'], ['0', '1'], $rowSpecification);
        $colSpecification = str_replace(['L', 'R'], ['0', '1'], $colSpecification);

        return new Seat((int)bindec($rowSpecification), (int)bindec($colSpecification));
    }

    /**
     * @return int
     */
    #[Pure] public function getId(): int
    {
        return 8 * $this->getRow() + $this->getColumn();
    }

    /**
     * @return int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getColumn(): int
    {
        return $this->column;
    }
}