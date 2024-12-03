<?php

namespace Knevelina\AdventOfCode\Util;

class StringConsumer
{
    private readonly string $input;
    private int $cursor;

    public function __construct(string $input)
    {
        $this->input = $input;
        $this->cursor = 0;
    }

    public function current(): ?string
    {
        return $this->input[$this->cursor] ?? null;
    }

    public function done(): bool
    {
        return $this->cursor >= strlen($this->input);
    }

    public function peek(int $length): string
    {
        return substr($this->input, $this->cursor, $length);
    }

    public function consume(int $length): string
    {
        $result = substr($this->input, $this->cursor, $length);
        $this->cursor += $length;
        return $result;
    }

    public function consumeIf(string $needle): bool
    {
        if ($this->peek($len = strlen($needle)) === $needle) {
            $this->cursor += $len;
            return true;
        }
        return false;
    }
}