<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day07;

use InvalidArgumentException;
use RuntimeException;
use WeakMap;

class Hand
{
    /**
     * @var array<Card>
     */
    public readonly array $cards;

    public readonly Type $type;

    /**
     * @param  array<Card>  $cards
     */
    private function __construct(array $cards, public readonly int $bid)
    {
        $this->cards = $cards;

        $this->type = static::determineType($cards);
    }

    public static function fromDescription(string $description): static
    {
        $parts = explode(' ', $description, 2);

        if (count($parts) !== 2) {
            throw new InvalidArgumentException(sprintf('Invalid hand description "%s"', $description));
        }

        return new static(static::parseCards($parts[0]), intval($parts[1]));
    }

    protected static function parseCards(string $cards): array
    {
        return array_map(Card::from(...), str_split($cards));
    }

    public static function compare(Hand $a, Hand $b): int
    {
        if ($b->type === $a->type) {
            for ($i = 0; $i < 5; $i++) {
                if ($b->cards[$i] === $a->cards[$i]) {
                    continue;
                }

                return $a->cards[$i]->getOrder() < $b->cards[$i]->getOrder() ? 1 : -1;
            }

            return 0;
        }

        return $a->type->value > $b->type->value ? 1 : -1;
    }

    protected static function determineType(array $cards): Type
    {
        /** @var WeakMap<Card, int> $cardMap */
        $cardMap = new WeakMap;

        foreach ($cards as $card) {
            $cardMap[$card] = ($cardMap[$card] ?? 0) + 1;
        }

        $counts = iterator_to_array($cardMap, false);
        rsort($counts);

        return match ($counts) {
            [5] => Type::FIVE_OF_A_KIND,
            [4, 1] => Type::FOUR_OF_A_KIND,
            [3, 2] => Type::FULL_HOUSE,
            [3, 1, 1] => Type::THREE_OF_A_KIND,
            [2, 2, 1] => Type::TWO_PAIR,
            [2, 1, 1, 1] => Type::ONE_PAIR,
            [1, 1, 1, 1, 1] => Type::HIGH_CARD,
            default => throw new RuntimeException(sprintf('Invalid sorted card arrangement %s', implode(', ', $cardMap))),
        };
    }
}
