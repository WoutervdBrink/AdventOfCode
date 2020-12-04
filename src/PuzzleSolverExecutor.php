<?php


namespace Knevelina\AdventOfCode;


use Knevelina\AdventOfCode\Contracts\PuzzleSolver;

class PuzzleSolverExecutor
{
    /**
     * Execute the puzzle solver for a certain day and part.
     *
     * @param int $day
     * @param int $part
     * @param string|null $input
     * @return
     */
    public static function execute(int $day, int $part, ?string $input = null)
    {
        if (is_null($input)) {
            $input = InputLoader::getInput($day);
        }

        $class = sprintf('Knevelina\\AdventOfCode\\Puzzles\\Day%02d', $day);

        if (!class_exists($class)) {
            echo $class;
            throw new \RuntimeException(sprintf('No implementation exists for day %d!', $day));
        }

        /** @var PuzzleSolver $solver */
        $solver = new $class();

        if (!($solver instanceof PuzzleSolver)) {
            throw new \RuntimeException(sprintf('The implementation for day %d is not a PuzzleSolver!', $day));
        }

        $method = sprintf('part%d', $part);

        return $solver->{$method}($input);
    }
}