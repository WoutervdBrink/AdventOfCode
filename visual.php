<?php

use Knevelina\AdventOfCode\PuzzleSolverExecutor;

require_once __DIR__.'/vendor/autoload.php';

if ($argc < 3) {
    echo 'Usage: php '.$argv[0].' YEAR DAY'.PHP_EOL;
    exit(1);
}

try {
    $year = $argv[1];
    $day = $argv[2];

    PuzzleSolverExecutor::visualize($year, $day);
} catch (RuntimeException $e) {
    echo $e->getMessage();
    exit(1);
}