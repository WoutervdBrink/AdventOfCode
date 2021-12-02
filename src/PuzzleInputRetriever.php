<?php

namespace Knevelina\AdventOfCode;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Knevelina\AdventOfCode\Traits\PutsFiles;

class PuzzleInputRetriever
{
    use PutsFiles;

    public static function retrievePuzzleInput(int $year, int $day)
    {
        if (self::putFileCallback(self::getPuzzleInputPath($year, $day), fn() => self::getPuzzleInput($year, $day))) {
            printf("Retrieved input for %04d day %02d\n", $year, $day);
        }
    }

    private static function getPuzzleInputPath(int $year, int $day): string
    {
        return sprintf('%s/../resources/inputs/%d/day%02d.txt', __DIR__, $year, $day);
    }

    private static function getPuzzleInput(int $year, int $day): string
    {
        $jar = CookieJar::fromArray(['session' => $_ENV['SESSION_COOKIE'] ?? ''], 'adventofcode.com');

        $client = new Client();

        $response = $client->request(
            'GET',
            sprintf('https://adventofcode.com/%d/day/%d/input', $year, $day),
            ['cookies' => $jar]
        );

        return $response->getBody();
    }
}