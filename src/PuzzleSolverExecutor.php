<?php


namespace Knevelina\AdventOfCode;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Contracts\PuzzleVisualizer;
use RuntimeException;

class PuzzleSolverExecutor
{
    /**
     * Execute the puzzle solver for a certain day and part.
     *
     * @param int $year
     * @param int $day
     * @param int $part
     * @param string|null $input
     * @return string|int
     */
    public static function execute(int $year, int $day, int $part, ?string $input = null, bool $reportTiming = false): string|int
    {
        if (is_null($input)) {
            $input = InputLoader::getInput($year, $day);
        }

        $class = sprintf('Knevelina\\AdventOfCode\\Puzzles\\Year%04d\\Day%02d', $year, $day);

        if (!class_exists($class)) {
            echo $class;
            throw new RuntimeException(sprintf('No implementation exists for day %d!', $day));
        }

        /** @var PuzzleSolver $solver */
        $solver = new $class();

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