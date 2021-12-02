<?php

use Dotenv\Dotenv;
use Knevelina\AdventOfCode\PuzzleInputRetriever;
use Knevelina\AdventOfCode\PuzzleSolverCreator;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

if ($argc < 3) {
    echo 'Usage: php ' . $argv[0] . ' YEAR DAY' . PHP_EOL;
    exit(1);
}

try {
    $year = intval($argv[1]);
    $day = intval($argv[2]);

    PuzzleSolverCreator::createPuzzle($year, $day);

    if (!empty($_ENV['SESSION_COOKIE'])) {
        PuzzleInputRetriever::retrievePuzzleInput($year, $day);
    }
} catch (RuntimeException | InvalidArgumentException $e) {
    echo $e->getMessage();
    exit(1);
}