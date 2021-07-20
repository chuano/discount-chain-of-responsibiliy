<?php

declare(strict_types=1);

namespace Tests;

use Discount\AmountAndUnitsRule;
use Discount\Discount;
use Discount\Rule;
use PHPUnit\Framework\TestCase;

class DiscountTest extends TestCase
{
    private Rule $rule;

    protected function setUp(): void
    {
        $this->rule = new AmountAndUnitsRule(15, 300, 50);      // (15%) MÁS DE 300€ Y 50 UNIDADES
        $this->rule->chain(new AmountAndUnitsRule(12, 0, 50));  // (12%) MÁS DE 50 UNIDADES
        $this->rule->chain(new AmountAndUnitsRule(10, 0, 30));  // (10%) MÁS DE 30 UNIDADES
        $this->rule->chain(new AmountAndUnitsRule(5, 100, 0));  // (5%)  MÁS DE 100€
    }

    /**
     * @test
     */
    public function should_return_15_discount_given_more_than_300_amount_and_more_than_50_units(): void
    {
        $discount = new Discount($this->rule);
        $this->assertEquals(15, $discount->getDiscount(301, 51));
    }

    /**
     * @test
     */
    public function should_return_12_discount_given_equal_or_less_than_300_amount_and_more_than_50_units(): void
    {
        $discount = new Discount($this->rule);
        $this->assertEquals(12, $discount->getDiscount(300, 51));
    }

    /**
     * @test
     */
    public function should_return_10_discount_given_any_amount_and_more_than_30_units(): void
    {
        $discount = new Discount($this->rule);
        $this->assertEquals(10, $discount->getDiscount(1, 31));
    }

    /**
     * @test
     */
    public function should_return_5_discount_given_more_than_100_amount_and_any_units(): void
    {
        $discount = new Discount($this->rule);
        $this->assertEquals(5, $discount->getDiscount(101, 1));
    }

    /**
     * @test
     */
    public function should_return_0_discount_given_less_or_equal_than_100_amount_and_less_or_equal_than_30_units(): void
    {
        $discount = new Discount($this->rule);
        $this->assertEquals(0, $discount->getDiscount(100, 30));
    }
}
