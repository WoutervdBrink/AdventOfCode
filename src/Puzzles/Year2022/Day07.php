<?php

namespace Knevelina\AdventOfCode\Puzzles\Year2022;

use Knevelina\AdventOfCode\Contracts\PuzzleSolver;
use Knevelina\AdventOfCode\Data\Structures\Stack;
use Knevelina\AdventOfCode\Data\Year2022\Day07\Directory;
use Knevelina\AdventOfCode\Data\Year2022\Day07\File;
use Knevelina\AdventOfCode\Data\Year2022\Day07\Node;
use Knevelina\AdventOfCode\InputManipulator;
use OutOfBoundsException;
use Override;

class Day07 implements PuzzleSolver
{
    #[Override]
    public function part1(string $input): float
    {
        $root = self::parseInput($input);

        return array_sum(array_filter(self::getDirectorySizes($root), fn (int $size): bool => $size <= 100000));
    }

    private static function parseInput(string $input): Directory
    {
        $input = InputManipulator::splitLines($input);

        // Ignore 'cd /'
        array_shift($input);

        $workingDirectory = new Stack;
        $workingDirectory->push($root = new Directory(''));

        foreach ($input as $line) {
            if ($line === '$ ls') {
                continue;
            } elseif ($line === '$ cd ..') {
                $workingDirectory->pop();
            } elseif (preg_match('/^\\$ cd ([a-z]+)$/', $line, $matches)) {
                $target = $matches[1];
                $found = false;

                foreach ($workingDirectory->peek()->getChildren() as $subDirectory) {
                    if ($subDirectory->getName() === $target) {
                        $found = true;
                        break;
                    }
                }

                if (! $found) {
                    throw new OutOfBoundsException(
                        sprintf('Trying to change into non-existing directory "%s"', $target)
                    );
                }

                $workingDirectory->push($subDirectory);
            } elseif (preg_match('/^(\d+) ([a-z.]+)$/', $line, $matches)) {
                $size = intval($matches[1]);
                $name = $matches[2];

                $workingDirectory->peek()->addChild(new File($name, $size));
            } elseif (preg_match('/^dir ([a-z]+)$/', $line, $matches)) {
                $name = $matches[1];

                $workingDirectory->peek()->addChild(new Directory($name));
            }
        }

        return $root;
    }

    private static function getDirectorySizes(Node $node): array
    {
        $sizes = [];

        if ($node instanceof Directory) {
            $sizes[] = $node->getSize();
        }

        foreach ($node->getChildren() as $child) {
            $sizes = array_merge($sizes, self::getDirectorySizes($child));
        }

        return $sizes;
    }

    #[Override]
    public function part2(string $input): int
    {
        $root = self::parseInput($input);
        $availableSizes = self::getDirectorySizes($root);
        $requiredSpace = $root->getSize() - 40_000_000;

        sort($availableSizes);

        foreach ($availableSizes as $size) {
            if ($size > $requiredSpace) {
                return $size;
            }
        }

        return 0;
    }
}
