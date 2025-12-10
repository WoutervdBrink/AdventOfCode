<?php

namespace Knevelina\AdventOfCode\Tests\Data\Year2020;

use InvalidArgumentException;
use Knevelina\AdventOfCode\Data\Year2020\Bag;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Bag::class)]
class BagTest extends TestCase
{
    #[Test]
    public function it_has_a_color()
    {
        $bag = new Bag('red');

        $this->assertEquals('red', $bag->getColor());
    }

    #[Test]
    public function it_rejects_invalid_colors(): void
    {
        $this->expectExceptionObject(new InvalidArgumentException('Specification is missing the bag color!'));

        Bag::fromSpecification('bags contain no other bags.');
    }

    #[Test]
    public function it_accepts_colors()
    {
        $bag = new Bag('red');
        $bag->accept('red', 1);
        $bag->accept('green', 2);

        $this->assertEquals(1, $bag->accepts('red'));
        $this->assertEquals(2, $bag->accepts('green'));

        $this->assertEquals(['red' => 1, 'green' => 2], $bag->getAcceptableColors());
    }

    #[Test]
    public function it_rejects_colors()
    {
        $bag = new Bag('red');
        $bag->accept('blue', 3);

        $this->assertEquals(0, $bag->accepts('green'));
    }

    public static function specifications(): array
    {
        return [
            [
                'light red bags contain 1 bright white bag, 2 muted yellow bags.',
                'light red',
                [1, 'bright white'],
                [2, 'muted yellow'],
            ],
            [
                'dark orange bags contain 3 bright white bags, 4 muted yellow bags.',
                'dark orange',
                [3, 'bright white'],
                [4, 'muted yellow'],
            ],
            ['bright white bags contain 1 shiny gold bag.', 'bright white', [1, 'shiny gold']],
            [
                'muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.',
                'muted yellow',
                [2, 'shiny gold'],
                [9, 'faded blue'],
            ],
            [
                'shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.',
                'shiny gold',
                [1, 'dark olive'],
                [2, 'vibrant plum'],
            ],
            [
                'dark olive bags contain 3 faded blue bags, 4 dotted black bags.',
                'dark olive',
                [3, 'faded blue'],
                [4, 'dotted black'],
            ],
            [
                'vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.',
                'vibrant plum',
                [5, 'faded blue'],
                [6, 'dotted black'],
            ],
            ['faded blue bags contain no other bags.', 'faded blue'],
            ['dotted black bags contain no other bags.', 'dotted black'],
        ];
    }

    #[DataProvider('specifications')]
    #[Test]
    public function it_parses_specifications(string $specification, string $color, array ...$acceptedColors): void
    {
        $bag = Bag::fromSpecification($specification);

        $this->assertEquals($bag->getColor(), $color, 'The bag\'s color was parsed incorrectly.');

        foreach ($acceptedColors as $acceptedColor) {
            $amount = $acceptedColor[0];
            $color = $acceptedColor[1];
            $actual = $bag->accepts($color);

            $this->assertEquals(
                $amount,
                $actual,
                sprintf('The bag does not accept %d %s bag(s): it accepts %d', $amount, $color, $actual)
            );
        }

        $this->assertEquals($bag->acceptsAnything(), count($acceptedColors) > 0);
    }

    /**
     * @noinspection PhpUnusedParameterInspection
     */
    #[DataProvider('specifications')]
    #[Test]
    public function it_has_a_to_string_method(string $specification, string $color, array ...$acceptedColors): void
    {
        $bag = Bag::fromSpecification($specification);

        $this->assertEquals($bag->__toString(), $specification);
    }
}
