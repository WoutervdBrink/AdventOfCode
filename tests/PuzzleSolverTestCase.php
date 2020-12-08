<?php


namespace Knevelina\AdventOfCode\Tests;


use Knevelina\AdventOfCode\InputLoader;
use Knevelina\AdventOfCode\PuzzleSolverExecutor;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

abstract class PuzzleSolverTestCase extends TestCase
{
    private int $year;
    private int $day;

    public abstract function getExamples(): array;

    /**
     * Get the solution for part 1.
     *
     * Override this method to enable regression tests.
     *
     * @return int|null
     */
    public function getSolutionForPart1(): int|null {
        return null;
    }

    /**
     * Get the solution for part 2.
     *
     * Override this method to enable regression tests.
     *
     * @return int|null
     */
    public function getSolutionForPart2(): int|null {
        return null;
    }

    public function setUp(): void
    {
        $reflection = new ReflectionClass($this);

        if (!preg_match('/^Day([0-9]+)Test$/', $reflection->getShortName(), $matches)) {
            throw new RuntimeException('The test class is invalid: it should be DayNNTest!');
        }

        $this->day = intval($matches[1]);

        if (!preg_match('/Year(\d{4})/', $reflection->getNamespaceName(), $matches)) {
            throw new RuntimeException('The test class is invalid: it should be in a YearNNNN namesapce!');
        }

        $this->year = intval($matches[1]);
    }

    /**
     * @dataProvider getExamples
     * @test
     * @param int $example
     * @param int $part
     * @param int $expected
     */
    function it_solves_an_example(int $example, int $part, int $expected): void
    {
        $input = InputLoader::getExample($this->year, $this->day, $example);

        $this->assertEquals($expected, PuzzleSolverExecutor::execute($this->year, $this->day, $part, $input));
    }

    /** @test */
    function it_solves_the_puzzle(): void
    {
        $part1 = $this->getSolutionForPart1();
        $part2 = $this->getSolutionForPart2();

        if (!is_null($part1)) {
            self::assertEquals($part1, PuzzleSolverExecutor::execute($this->year, $this->day, 1));
        }

        if (!is_null($part2)) {
            self::assertEquals($part2, PuzzleSolverExecutor::execute($this->year, $this->day, 2));
        }

        if (is_null($part1) && is_null($part2)) {
            // Prevent PHPUnit from complaining when we haven't solved the puzzle yet.
            self::assertTrue(true);
        }
    }
}