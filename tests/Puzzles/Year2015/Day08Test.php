<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day08;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Day08::class)]
class Day08Test extends PuzzleSolverTestCase
{
    public static function regularStrings(): array
    {
        return [
            ['""', 0, '"\\"\\""'],
            ['"abc"', 3, '"\\"abc\\""'],
            ['"abcde"', 5, '"\\"abcde\\""'],
            ['"abcdefg"', 7, '"\\"abcdefg\\""'],
            ['"abc\\defg"', 8, '"\\"abc\\\\defg\\""'],
        ];
    }

    public static function stringsWithDoubleQuoteCharacters(): array
    {
        return [
            ['"\\""', 1, '"\"\\\\\\"\\""'],             // "\""     \"\\\"\"
            ['"a\\""', 2, '"\\"a\\\\\\"\""'],           // "a\""    \"a\\\"\"
            ['"\\"a"', 2, '"\\"\\\\\\"a\\""'],          // "\"a"    \"\\\"a\"
            ['"\\"\\""', 2, '"\\"\\\\\\"\\\\\\"\\""'],  // "\"\""   \"\\\"\\\"\"
            ['"\\"a\\""', 3, '"\\"\\\\\\"a\\\\\\"\\""'], // "\"a\""  \"\\\"a\\\"\"
        ];
    }

    public static function stringsWithBackslashes(): array
    {
        return [
            ['"\\\\"', 1, '"\\"\\\\\\\\\\""'],      // "\\" \"\\\\\"
            ['"\\\\\\\\"', 2, '"\\"\\\\\\\\\\\\\\\\\\""'],  // "\\\\" \"\\\\\\\\\"
            ['"a\\\\"', 2, '"\\"a\\\\\\\\\\""'],     // "a\\" \"a\\\\\"
            ['"\\\\a"', 2, '"\\"\\\\\\\\a\\""'],     // "\\a" \"\\\\a\"
            ['"\\\\a\\\\"', 3, '"\\"\\\\\\\\a\\\\\\\\\\""'],  // "\\a\\" \"\\\\a\\\\\"
        ];
    }

    public static function stringsWithHexadecimalASCIICodes(): array
    {
        return [
            ['"\\x01"', 1],
            ['"\\xaa"', 2],
            ['"\\x1a"', 1],
            ['"\\xaz"', 4],
        ];
    }

    #[Test]
    #[DataProvider('regularStrings')]
    #[DataProvider('stringsWithDoubleQuoteCharacters')]
    #[DataProvider('stringsWithBackslashes')]
    public function it_calculates_string_lengths_and_encodes_strings(string $codeString, int $length, string $encoded): void
    {
        $this->assertEquals($length, Day08::getStringLength($codeString));

        $this->assertEquals(strlen($encoded), Day08::getEncodedLength($codeString));
    }

    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 12],
            [1, 2, 19],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): int
    {
        return 1350;
    }

    #[Override]
    public function getSolutionForPart2(): int
    {
        return 2085;
    }
}
