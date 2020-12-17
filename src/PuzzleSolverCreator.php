<?php

namespace Knevelina\AdventOfCode;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class PuzzleSolverCreator
{
    public static function createPuzzle(int $year, int $day): void
    {
        if ($year < 2015) {
            throw new InvalidArgumentException(sprintf("Invalid year %d!", $year));
        }

        if ($day < 1 || $day > 25) {
            throw new InvalidArgumentException(sprintf("Invalid day %d!", $day));
        }

        if (!file_exists($path = static::getPuzzleSolverPath($year, $day))) {
            file_put_contents($path, static::getPuzzleSolver($year, $day));

            printf("Created puzzle solver for %04d day %02d.\n", $year, $day);
        }

        if (!file_exists($path = static::getPuzzleTestPath($year, $day))) {
            file_put_contents($path, static::getPuzzleTest($year, $day));

            printf("Created test for %04d day %02d.\n", $year, $day);
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