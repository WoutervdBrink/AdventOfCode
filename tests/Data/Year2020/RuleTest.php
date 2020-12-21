<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\Rule;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Knevelina\AdventOfCode\Data\Year2020\Rule
 */
class RuleTest extends TestCase
{
    public function rules(): array
    {
        return [
            ['1 2', [1, 2]],
            ['"a"', 'a'],
            ['1 3 | 3 1', [1, 3], [3, 1]],
            ['1 2 3', [1, 2, 3]],
            ['"a" | 1 2', 'a', [1, 2]]
        ];
    }

    /**
     * @dataProvider rules
     * @test
     * @param string $rule
     * @param array ...$alternatives
     */
    function it_parses_rules(string $rule, mixed ...$alternatives): void
    {
        $rule = Rule::fromSpecification($rule);

        $this->assertEquals($alternatives, $rule->getAlternatives());
    }
}