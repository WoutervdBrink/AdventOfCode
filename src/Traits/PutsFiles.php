<?php

namespace Knevelina\AdventOfCode\Traits;

trait PutsFiles
{
    private static function putDirForPath(string $path): bool
    {
        if (! is_dir($dir = dirname($path))) {
            mkdir($dir, 0770, true);

            return true;
        }

        return false;
    }

    private static function putFile(string $path, string $contents): bool
    {
        self::putDirForPath($path);

        if (! file_exists($path)) {
            file_put_contents($path, $contents);

            return true;
        }

        return false;
    }

    private static function putFileCallback(string $path, callable $callback): bool
    {
        if (self::hasFile($path)) {
            return false;
        }

        $contents = $callback();

        self::putDirForPath($path);
        file_put_contents($path, $contents);

        return true;
    }

    private static function hasFile(string $path): bool
    {
        return file_exists($path);
    }
}
