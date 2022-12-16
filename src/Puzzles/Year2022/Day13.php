<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Stack;
use Knevelina\AdventOfCode\Data\Year2022\Day13\Result;
use Knevelina\AdventOfCode\InputManipulator;

class Day13 implements PuzzleSolver
{
    private static function parsePacket(string $packet): array
    {
        $stack = new Stack();

        $stack->push(new \ArrayObject());
        $value = '';

        $packet = str_split($packet);

        foreach ($packet as $char) {
            switch ($char) {
                case ',':
                    if (strlen($value)) {
                        $stack->peek()->append(intval($value));
                        $value = '';
                    }
                    break;
                case '[':
                    $stack->push(new \ArrayObject());
                    break;
                case ']':
                    if (strlen($value)) {
                        $stack->peek()->append(intval($value));
                        $value = '';
                    }
                    $child = (array) $stack->pop();
                    $stack->peek()->append($child);
                    break;
                default:
                    if ($char >= '0' && $char <= '9') {
                        $value .= $char;
                    }
                    break;
            }
        }

        return (array) $stack->pop()[0];
    }

    private static function parsePair(string $pair): array
    {
        [$first, $second] = explode("\n", $pair);

        return [
            self::parsePacket($first),
            self::parsePacket($second)
        ];
    }

    /**
     * @param string $input
     * @return array<int, array<array|int>>
     */
    private static function parseInput(string $input): array 
    {
        return InputManipulator::splitLines($input, delimiter: "\n\n", manipulator: fn (string $pair): array => self::parsePair($pair));
    }

    private static function verifyList(array $list1, array $list2): Result
    {
        $l = 0;
        $r = 0;

        while ($l < count($list1) && $r < count($list2)) {
            $left = $list1[$l];
            $right = $list2[$r];

            if (is_integer($left) && is_integer($right)) {
                if ($left < $right) {
                    return Result::VALID;
                } elseif ($left > $right) {
                    return Result::INVALID;
                } else {
                    $l++;
                    $r++;
                    continue;
                }
            }

            if (is_array($left) && is_array($right)) {
                $result = self::verifyList($left, $right);

                if ($result->isDecisive()) {
                    return $result;
                }

                $l++;
                $r++;
                continue;
            }

            if (is_integer($left) && !is_integer($right)) {
                $list1[$l] = [$left];
            } elseif (is_integer($right) && !is_integer($left)) {
                $list2[$r] = [$right];
            }
        }

        if ($l === count($list1) && $r < count($list2)) {
            return Result::VALID;
        } elseif ($r === count($list2) && $l < count($list1)) {
            return Result::INVALID;
        } elseif ($l === count($list1) && $r === count($list2)) {
            return Result::INDECISIVE;
        }

        return Result::INDECISIVE;
    }
    
    public function part1(string $input): int
    {
        $lists = self::parseInput($input);

        $sum = 0;

        foreach ($lists as $index => $pair) {
            if (self::verifyList($pair[0], $pair[1]) === Result::VALID) {
                $sum += $index + 1;
            }
        }

        return $sum;
    }

    public function part2(string $input): int
    {
        $input = self::parseInput($input);

        $packets = array_reduce(
            $input,
            fn (array $packets, array $pair) => [...$packets, ...$pair],
            [ [[2]], [[6]] ]
        );

        usort($packets, function (array $packet1, array $packet2): int {
            $result = self::verifyList($packet1, $packet2);

            return match($result) {
                Result::VALID => -1,
                Result::INDECISIVE => 0,
                Result::INVALID => 1
            };
        });

        $sum = 1;

        foreach ($packets as $index => $packet) {
            if ($packet === [[2]] || $packet === [[6]]) {
                $sum *= $index + 1;
            }
        }

        return $sum;
    }
}