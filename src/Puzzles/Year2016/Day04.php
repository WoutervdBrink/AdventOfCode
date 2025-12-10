<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2016;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputManipulator;
use Override;
use RuntimeException;

class Day04 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $input = self::parseInput($input);

        $sum = 0;

        foreach ($input as $room) {
            $occurrence = [];
            foreach (str_split($room->name) as $letter) {
                if ($letter < 'a' || $letter > 'z') {
                    continue;
                }

                if (! isset($occurrence[$letter])) {
                    $occurrence[$letter] = 0;
                }

                $occurrence[$letter]++;
            }

            $occurrence = array_map(null, array_keys($occurrence), array_values($occurrence));

            usort($occurrence, function (array $a, array $b): int {
                [$aLetter, $aLength] = $a;
                [$bLetter, $bLength] = $b;

                if ($aLength === $bLength) {
                    if ($aLetter === $bLetter) {
                        return 0;
                    }

                    return $aLetter < $bLetter ? -1 : 1;
                }

                return $aLength < $bLength ? 1 : -1;
            });

            $actualChecksum = implode(
                '',
                array_map(fn (array $element): string => $element[0], array_slice($occurrence, 0, 5))
            );

            if ($actualChecksum === $room->checksum) {
                $sum += $room->id;
            }
        }

        return $sum;
    }

    private static function parseInput(string $input): array
    {
        return InputManipulator::splitLines($input, manipulator: function (string $line): object {
            if (! preg_match('/^(([a-z]+-)+)(\d+)\[([a-z]+)]$/', $line, $matches)) {
                throw new RuntimeException(sprintf('Invalid room specification "%s"', $line));
            }

            $name = explode('-', $matches[1]);
            array_pop($name);

            return (object) [
                'name' => substr($matches[1], 0, -1),
                'id' => intval($matches[3]),
                'checksum' => $matches[4],
            ];
        });
    }

    #[Override]
    public function part2(string $input): int
    {
        $input = self::parseInput($input);

        foreach ($input as $room) {
            $decrypted = '';

            for ($i = 0; $i < strlen($room->name); $i++) {
                $encrypted = $room->name[$i];

                if (! ctype_alpha($encrypted)) {
                    $decrypted .= $encrypted;

                    continue;
                }

                $encrypted = ord($encrypted) + $room->id - ord('a');
                $decrypted .= chr(fmod($encrypted, 26) + ord('a'));
            }

            if ($decrypted === 'northpole-object-storage') {
                return $room->id;
            }
        }

        return 0;
    }
}
