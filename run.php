<?php

use Knevelina\AdventOfCode\PuzzleSolverExecutor;

require_once __DIR__.'/vendor/autoload.php';

if ($argc < 2) {
    echo 'Usage: php '.$argv[0].' <day> [part]'.PHP_EOL;
    exit(1);
}

try {
    $day = $argv[1];
    $part = max(0, min(2, intval($argv[2] ?? 0)));

    if ($part === 1 || $part === 0) {
        echo PuzzleSolverExecutor::execute($argv[1], 1);
        echo PHP_EOL;
    }

    if ($part === 2 || $part === 0) {
        echo PuzzleSolverExecutor::execute($argv[1], 2);
        echo PHP_EOL;
    }
} catch (RuntimeException $e) {
    echo $e->getMessage();
    exit(1);
}