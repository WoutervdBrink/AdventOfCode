<?php

namespace Knevelina\AdventOfCode\Data\Year2023\Day07;

enum Type: int
{
    case FIVE_OF_A_KIND = 70;
    case FOUR_OF_A_KIND = 60;
    case FULL_HOUSE = 50;
    case THREE_OF_A_KIND = 40;
    case TWO_PAIR = 30;
    case ONE_PAIR = 20;
    case HIGH_CARD = 10;
}
