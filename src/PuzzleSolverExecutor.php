<?php


namespace Knevelina\AdventOfCode;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use RuntimeException;

class PuzzleSolverExecutor
{
    /**
     * Execute the puzzle solver for a certain day and part.
     *
     * @param int $day
     * @param int $part
     * @param string|null $input
     * @return int
     */
    public static function execute(int $year, int $day, int $part, ?string $input = null): int
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

        return $solver->{$method}($input);
    }
}