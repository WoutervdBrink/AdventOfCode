<?php

use Knevelina\AdventOfCode\InputLoader;
use Knevelina\AdventOfCode\PuzzleSolverExecutor;

require_once __DIR__.'/vendor/autoload.php';

if ($argc < 3) {
    echo 'Usage: php '.$argv[0].' YEAR DAY [PART]'.PHP_EOL;
    exit(1);
}

try {
    $year = intval($argv[1]);
    $day = intval($argv[2]);
    $part = max(0, min(2, intval($argv[3] ?? 0)));

    $solver = PuzzleSolverExecutor::getSolver($year, $day);
    $input = InputLoader::getInput($year, $day);

    if ($part === 1 || $part === 0) {
        echo PuzzleSolverExecutor::execute($solver, 1, $input, reportTiming: true);
        echo PHP_EOL;
    }

    if ($part === 2 || $part === 0) {
        echo PuzzleSolverExecutor::execute($solver, 2, $input, reportTiming: true);
        echo PHP_EOL;
    }
} catch (RuntimeException $e) {
    echo $e->getMessage();
    exit(1);
}