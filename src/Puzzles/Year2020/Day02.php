<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2020;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Year2020\Password;
use Knevelina\AdventOfCode\InputManipulator;
use Override;

class Day02 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): int
    {
        $specifications = InputManipulator::splitLines($input);

        $passwords = array_map(fn ($spec) => Password::fromSpecification($spec), $specifications);

        return count(
            array_filter(
                $passwords,
                fn ($password) => $password->getCharacterOccurrence() >= $password->getMin() &&
                    $password->getCharacterOccurrence() <= $password->getMax()
            )
        );
    }

    #[Override]
    public function part2(string $input): int
    {
        $specifications = InputManipulator::splitLines($input);

        $passwords = array_map(fn ($spec) => Password::fromSpecification($spec), $specifications);

        return count(
            array_filter(
                $passwords,
                fn ($password) => ($password->getCharacterAt($password->getMin()) === $password->getLetter() ? 1 : 0) ^
                    ($password->getCharacterAt($password->getMax()) === $password->getLetter() ? 1 : 0)
            )
        );
    }
}
