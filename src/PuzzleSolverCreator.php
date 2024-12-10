<?php

namespace Knevelina\AdventOfCode;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use Knevelina\AdventOfCode\Traits\PutsFiles;

class PuzzleSolverCreator
{
    use PutsFiles;

    public static function createPuzzle(int $year, int $day): void
    {
        if ($year < 2015) {
            throw new InvalidArgumentException(sprintf("Invalid year %d!", $year));
        }

        if ($day < 1 || $day > 25) {
            throw new InvalidArgumentException(sprintf("Invalid day %d!", $day));
        }

        if (static::putFile(static::getPuzzleSolverPath($year, $day), self::getPuzzleSolver($year, $day))) {
            printf("Created puzzle solver for %04d day %02d.\n", $year, $day);
        }

        if (static::putFile(static::getPuzzleTestPath($year, $day), static::getPuzzleTest($year, $day))) {
            printf("Created test for %04d day %02d.\n", $year, $day);
        }

        if (static::putFile(static::getExamplePath($year, $day), '')) {
            printf("Created example for %04d day %02d.\n", $year, $day);
        }
    }

    #[Pure] private static function getPuzzleSolverPath(int $year, int $day): string
    {
        return sprintf('%s/Puzzles/Year%04d/Day%02d.php', __DIR__, $year, $day);
    }

    private static function getPuzzleSolver(int $year, int $day): string
    {
        $stub = static::getStub('puzzle_solver');

        static::transformStub($stub, 'year', sprintf('%04d', $year));
        static::transformStub($stub, 'day', sprintf('%02d', $day));

        return $stub;
    }

    private static function getStub(string $stub): string
    {
        $path = sprintf('%s/../resources/stubs/%s.stub', __DIR__, $stub);

        if (!file_exists($path)) {
            throw new InvalidArgumentException(sprintf('Stub "%s" does not exist! %s', $stub, $path));
        }

        return file_get_contents($path);
    }

    private static function transformStub(string &$stub, string $key, string $value): void
    {
        $stub = str_replace('$' . strtoupper($key) . '$', $value, $stub);
    }

    #[Pure] private static function getExamplePath(int $year, int $day): string
    {
        return sprintf("%s/../resources/examples/%04d/%02d/example1.txt", __DIR__, $year, $day);
    }

    #[Pure] private static function getPuzzleTestPath(int $year, int $day): string
    {
        return sprintf('%s/../tests/Puzzles/Year%04d/Day%02dTest.php', __DIR__, $year, $day);
    }

    private static function getPuzzleTest(int $year, int $day): string
    {
        $stub = static::getStub('puzzle_test');

        static::transformStub($stub, 'year', sprintf('%04d', $year));
        static::transformStub($stub, 'day', sprintf('%02d', $day));

        return $stub;
    }
}