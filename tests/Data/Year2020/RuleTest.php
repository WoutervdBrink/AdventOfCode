<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\Rule;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Rule::class)]
class RuleTest extends TestCase
{
    public static function rules(): array
    {
        return [
            ['1 2', [1, 2]],
            ['"a"', 'a'],
            ['1 3 | 3 1', [1, 3], [3, 1]],
            ['1 2 3', [1, 2, 3]],
            ['"a" | 1 2', 'a', [1, 2]],
        ];
    }

    /**
     * @param  array  ...$alternatives
     */
    #[Test]
    #[DataProvider('rules')]
    public function it_parses_rules(string $rule, mixed ...$alternatives): void
    {
        $rule = Rule::fromSpecification($rule);

        $this->assertEquals($alternatives, $rule->getAlternatives());
    }
}
