<?php

namespace Knevelina\AdventOfCode\Tests\Puzzles\Year2015;

use Knevelina\AdventOfCode\Puzzles\Year2015\Day11;
use Knevelina\AdventOfCode\Tests\PuzzleSolverTestCase;

/**
 * @covers \Knevelina\AdventOfCode\Puzzles\Year2015\Day11
 */
class Day11Test extends PuzzleSolverTestCase
{
    public function getExamples(): array
    {
        return [
            [1, 1, 'abcdffaa'],
            [2, 1, 'ghjaabcc']
        ];
    }

    /**
     * @test
     * @dataProvider firstRequirementExamples
     */
    function it_tests_the_first_requirement(bool $meets, string $password): void
    {
        $password = Day11::encodePassword($password);

        $this->assertEquals($meets, Day11::rule1($password));
    }

    /**
     * @test
     * @dataProvider secondRequirementExamples
     */
    function it_tests_the_second_requirement(bool $meets, string $password): void
    {
        $password = Day11::encodePassword($password);

        $this->assertEquals($meets, Day11::rule2($password));
    }

    /**
     * @test
     * @dataProvider thirdRequirementExamples
     */
    function it_tests_the_third_requirement(bool $meets, string $password): void
    {
        $password = Day11::encodePassword($password);

        $this->assertEquals($meets, Day11::rule3($password));
    }

    public function firstRequirementExamples(): array
    {
        return [
            [true, 'hijklmmn'],
            [false, 'abbceffg'],
            [true, 'abcdffaa'],
            [true, 'ghjaabcc'],
        ];
    }

    public function secondRequirementExamples(): array
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

    public function thirdRequirementExamples(): array
    {
        return [
            [true, 'abbceffg'],
            [false, 'abbcegjk'],
            [true, 'abcdffaa'],
            [true, 'ghjaabcc'],
        ];
    }

    public function getSolutionForPart1(): string
    {
        return 'hxbxxyzz';
    }

    public function getSolutionForPart2(): string|int|null
    {
        return 'hxcaabcc';
    }
}