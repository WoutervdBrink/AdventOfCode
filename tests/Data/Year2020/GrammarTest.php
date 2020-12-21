<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use Knevelina\AdventOfCode\Data\Year2020\Grammar;
use Knevelina\AdventOfCode\Data\Year2020\Rule;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Knevelina\AdventOfCode\Data\Year2020\Grammar
 */
class GrammarTest extends TestCase
{
    public function grammars(): array
    {
        return [
            [['0: 1 2'], [[1, 2]]],
            [['0: "a"'], ['a']],
            [['0: "a"', '1: 1 2'], ['a'], [[1, 2]]],
            [['1: 1 2', '0: "a"'], ['a'], [[1, 2]]]
        ];
    }

    /**
     * @dataProvider grammars
     * @test
     * @param array $spec
     * @param array ...$rules
     */
    function it_parses_grammars(array $spec, array ...$rules): void
    {
        $grammar = Grammar::fromSpecification(implode("\n", $spec));

        foreach ($rules as $id => $alternatives) {
            $rule = $grammar->getRule($id);

            $this->assertEquals($alternatives, $rule->getAlternatives());
        }
    }

    /** @test */
    function it_returns_rules(): void
    {
        $rule0 = Rule::fromSpecification('1 2');
        $rule1 = Rule::fromSpecification('"a"');
        $grammar = new Grammar([$rule0, $rule1]);

        $this->assertEquals([$rule0, $rule1], $grammar->getRules());
        $this->assertEquals($rule0, $grammar->getRule(0));
        $this->assertEquals($rule1, $grammar->getRule(1));
    }

    /** @test */
    function it_reports_undefined_rules(): void
    {
        $rule0 = Rule::fromSpecification('1 2');
        $rule1 = Rule::fromSpecification('"a"');
        $grammar = new Grammar([$rule0, $rule1]);

        $this->expectExceptionMessage('Rule 3 does not exist.');

        $grammar->getRule(3);
    }
}