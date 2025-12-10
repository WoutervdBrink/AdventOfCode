<?php

use Dotenv\Dotenv;
use Knevelina\AdventOfCode\PuzzleInputRetriever;
use Knevelina\AdventOfCode\PuzzleSolverCreator;

require_once __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$year = intval(date('Y'));
$day = intval(date('j'));

if ($argc === 3) {
    $year = intval($argv[1]);
    $day = intval($argv[2]);
} elseif ($argc === 2) {
    $day = intval($argv[1]);
}

try {
    PuzzleSolverCreator::createPuzzle($year, $day);

    if (! empty($_ENV['SESSION_COOKIE'])) {
        PuzzleInputRetriever::retrievePuzzleInput($year, $day);
    }
} catch (RuntimeException|InvalidArgumentException $e) {
    echo $e->getMessage();
    exit(1);
}
