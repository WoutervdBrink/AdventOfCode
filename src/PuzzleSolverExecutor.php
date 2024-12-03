<?php


namespace Knevelina\AdventOfCode;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Contracts\PuzzleVisualizer;
use RuntimeException;

class PuzzleSolverExecutor
{
    public static function getSolver(int $year, int $day): PuzzleSolver
    {
        $class = sprintf('Knevelina\\AdventOfCode\\Puzzles\\Year%04d\\Day%02d', $year, $day);

        if (!class_exists($class)) {
            throw new RuntimeException(sprintf('No implementation exists for %d day %d!', $year, $day));
        }

        if (!class_implements($class, PuzzleSolver::class)) {
            throw new RuntimeException(sprintf('The implementation for %d day %d is not an AbstractPuzzleSolver!', $year, $day));
        }

        return new $class();
    }

    /**
     * Execute the puzzle solver for a certain day and part.
     *
     * @param int $year
     * @param int $day
     * @param int $part
     * @param string $input
     * @param bool $reportTiming
     * @return string|int
     */
    public static function execute(PuzzleSolver $solver, int $part, string $input, bool $reportTiming = false): string|int
    {
        $method = sprintf('part%d', $part);

        $time = -hrtime(true);
        $result = $solver->{$method}($input);
        $time += hrtime(true);

        if ($reportTiming) {
            printf('Elapsed time: %.3f µs%s', $time / 1e3, PHP_EOL);
        }

        return $result;
    }

    public static function visualize(int $year, int $day): void
    {
        $input = InputLoader::getInput($year, $day);

        $class = sprintf('Knevelina\\AdventOfCode\\Visuals\\Year%04d\\Day%02d', $year, $day);

        if (!class_exists($class)) {
            echo $class;
            throw new RuntimeException(sprintf('No visualization exists for day %d!', $day));
        }

        /** @var PuzzleVisualizer $solver */
        $solver = new $class();

        $path = sprintf('%s/../visuals/year%04d_day%02d', __DIR__, $year, $day);

        $solver->visualize($input, $path);
    }
}