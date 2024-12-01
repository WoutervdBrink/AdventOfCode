<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day07;

enum Card: string
{
    case ACE = 'A';
    case KING = 'K';
    case QUEEN = 'Q';
    case JACK = 'J';
    case TEN = 'T';
    case NINE = '9';
    case EIGHT = '8';
    case SEVEN = '7';
    case SIX = '6';
    case FIVE = '5';
    case FOUR = '4';
    case THREE = '3';
    case TWO = '2';

    case JOKER = '*';

    const ORDER = [Card::ACE, Card::KING, Card::QUEEN, Card::JACK, Card::TEN, Card::NINE, Card::EIGHT, Card::SEVEN, Card::SIX, Card::FIVE, Card::FOUR, Card::THREE, Card::TWO, Card::JOKER];

    public function getOrder(): int
    {
        $order = array_search($this, self::ORDER);

        if ($order === false) {
            return PHP_INT_MAX;
        }

        return $order;
    }

    public function getJokerOrder(): int
    {
        if ($this === Card::JACK) {
            return PHP_INT_MAX;
        }

        return $this->getOrder();
    }
}
