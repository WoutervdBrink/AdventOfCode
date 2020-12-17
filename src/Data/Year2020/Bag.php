<?php


namespace Knevelina\AdventOfCode\Data\Year2020;


use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class Bag
{
    private string $color;

    private array $acceptableColors;

    /**
     * Construct a new bag.
     *
     * @param string $color
     */
    public function __construct(string $color)
    {
        $this->color = $color;
        $this->acceptableColors = [];
    }

    /**
     * Construct a new bag from the string specification of a bag.
     *
     * @param string $specification
     * @return Bag
     */
    public static function fromSpecification(string $specification): Bag
    {
        if (!preg_match('/^([a-z ]+) bags contain/', $specification, $matches)) {
            throw new InvalidArgumentException('Specification is missing the bag color!');
        }

        $bag = new Bag($matches[1]);

        unset($matches);

        preg_match_all('/(\\d+) ([a-z ]+) bags?[,.]/', $specification, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $bag->accept($match[2], intval($match[1]));
        }

        return $bag;
    }

    /**
     * Accept a new color.
     *
     * @param string $color
     * @param int $amount
     */
    public function accept(string $color, int $amount): void
    {
        $this->acceptableColors[$color] = $amount;
    }

    /**
     * @return array
     */
    #[Pure] public function getAcceptableColors(): array
    {
        return $this->acceptableColors;
    }

    /**
     * Check if the bag accepts a certain color.
     *
     * If so, the amount of accepted bags is returned. Otherwise, 0 is returned.
     *
     * @param string $color
     * @return int
     */
    #[Pure] public function accepts(string $color): int
    {
        return $this->acceptableColors[$color] ?? 0;
    }

    #[Pure] public function acceptsAnything(): bool
    {
        return count($this->acceptableColors) > 0;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s bags contain %s.',
            $this->getColor(),
            count($this->acceptableColors) > 0
                ? implode(
                ', ',
                array_map(
                    fn(string $color, int $amount) => sprintf('%d %s bag%s', $amount, $color, $amount === 1 ? '' : 's'),
                    array_keys($this->acceptableColors),
                    $this->acceptableColors
                )
            )
                : 'no other bags'
        );
    }

    /**
     * Get the color of this bag.
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }
}