<?php

function append_zero(int $x): string {
    return $x < 10 ? '0'.$x : $x;
}

if ($argc < 2) {
    echo 'Usage: php '.$argv[0].' <day> [part]'.PHP_EOL;
    exit(1);
}

$day = append_zero(intval($argv[1]));
$part = intval($argv[2] ?? 0);
$part = append_zero(max(0, min(2, $part)));

$file = sprintf('%s/puzzles/day%s.php', __DIR__, $day);
$input = sprintf('%s/input/day%s', __DIR__, $day);
$template = sprintf('%s/solution.php', __DIR__);

if (!file_exists($input)) {
    echo 'The puzzle input does not exist yet!'.PHP_EOL;
    echo 'I will create one for you.'.PHP_EOL;
    file_put_contents($input, '');
}

if (!file_exists($file)) {
    echo 'The puzzle solution does not exist yet!'.PHP_EOL;
    echo 'I will create one for you.'.PHP_EOL;
    file_put_contents($file, file_get_contents($template));
    exit(1);
}

/** @noinspection PhpIncludeInspection */
require_once $file;

$input = file_get_contents($input);

switch ($part) {
    case 0:
        echo part1($input).PHP_EOL;
        echo part2($input).PHP_EOL;
        break;
    case 1:
        echo part1($input).PHP_EOL;
        break;
    case 2:
        echo part2($input).PHP_EOL;
        break;
}