<?php

use Knevelina\AdventOfCode\PuzzleSolverCreator;

require_once __DIR__.'/vendor/autoload.php';

if ($argc < 3) {
    echo 'Usage: php '.$argv[0].' YEAR DAY'.PHP_EOL;
    exit(1);
}

try {
    $year = intval($argv[1]);
    $day = intval($argv[2]);

    PuzzleSolverCreator::createPuzzle($year, $day);
} catch (RuntimeException|InvalidArgumentException $e) {
    echo $e->getMessage();
    exit(1);
}