<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day11;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;
use Override;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(Day11::class)]
class Day11Test extends PuzzleSolverTestCase
{
    #[Override]
    public static function getExamples(): array
    {
        return [
            [1, 1, 'abcdffaa'],
            [2, 1, 'ghjaabcc'],
        ];
    }

    #[Test]
    #[DataProvider('firstRequirementExamples')]
    public function it_tests_the_first_requirement(bool $meets, string $password): void
    {
        $password = Day11::encodePassword($password);

        $this->assertEquals($meets, Day11::rule1($password));
    }

    #[Test]
    #[DataProvider('secondRequirementExamples')]
    public function it_tests_the_second_requirement(bool $meets, string $password): void
    {
        $password = Day11::encodePassword($password);

        $this->assertEquals($meets, Day11::rule2($password));
    }

    #[Test]
    #[DataProvider('thirdRequirementExamples')]
    public function it_tests_the_third_requirement(bool $meets, string $password): void
    {
        $password = Day11::encodePassword($password);

        $this->assertEquals($meets, Day11::rule3($password));
    }

    /**
     * @return array{0: bool, 1: string}[]
     */
    public static function firstRequirementExamples(): array
    {
        return [
            [true, 'hijklmmn'],
            [false, 'abbceffg'],
            [true, 'abcdffaa'],
            [true, 'ghjaabcc'],
        ];
    }

    /**
     * @return array{0: bool, 1: string}[]
     */
    public static function secondRequirementExamples(): array
    {
        return [
            [false, 'hijknmmn'],
            [false, 'hojknmmn'],
            [false, 'hljknmmn'],
            [true, 'aaaaaaaa'],
            [true, 'abcdffaa'],
            [true, 'ghjaabcc'],
        ];
    }

    /**
     * @return array{0: bool, 1: string}[]
     */
    public static function thirdRequirementExamples(): array
    {
        return [
            [true, 'abbceffg'],
            [false, 'abbcegjk'],
            [true, 'abcdffaa'],
            [true, 'ghjaabcc'],
        ];
    }

    #[Override]
    public function getSolutionForPart1(): string
    {
        return 'hxbxxyzz';
    }

    #[Override]
    public function getSolutionForPart2(): string
    {
        return 'hxcaabcc';
    }
}
