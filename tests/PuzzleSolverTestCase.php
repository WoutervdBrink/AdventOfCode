<?php


namespace Knevelina\AdventOfCode\Tests;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\InputLoader;
use Knevelina\AdventOfCode\PuzzleSolverExecutor;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

abstract class PuzzleSolverTestCase extends TestCase
{
    private int $year;
    private int $day;

    private PuzzleSolver $solver;

    public abstract function getExamples(): array;

    /**
     * Get the solution for part 1.
     *
     * Override this method to enable regression tests.
     *
     * @return string|int|float|null
     */
    public function getSolutionForPart1(): string|int|float|null {
        return null;
    }

    /**
     * Get the solution for part 2.
     *
     * Override this method to enable regression tests.
     *
     * @return string|int|float|null
     */
    public function getSolutionForPart2(): string|int|float|null {
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

        $this->solver = PuzzleSolverExecutor::getSolver($this->year, $this->day);
    }

    /**
     * @dataProvider getExamples
     * @test
     * @param int $example
     * @param int $part
     * @param string|int $expected
     */
    function it_solves_an_example(int $example, int $part, string|int $expected): void
    {
        $input = InputLoader::getExample($this->year, $this->day, $example);
        $result = $part === 1 ? $this->solver->part1($input) : $this->solver->part2($input);

        $this->assertEquals($expected, $result);
    }

    /** @test */
    function it_solves_the_puzzle(): void
    {
        $part1 = $this->getSolutionForPart1();
        $part2 = $this->getSolutionForPart2();
        $input = InputLoader::getInput($this->year, $this->day);

        if (!is_null($part1)) {
            self::assertEquals($part1, $this->solver->part1($input));
        }

        if (!is_null($part2)) {
            self::assertEquals($part2, $this->solver->part2($input));
        }

        if (is_null($part1) && is_null($part2)) {
            // Prevent PHPUnit from complaining when we haven't solved the puzzle yet.
            self::assertTrue(true);
        }
    }
}