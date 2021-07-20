<?php

declare(strict_types=1);

namespace Discount;

class Discount
{
    private Rule $rule;

    public function __construct(Rule $rule)
    {
        $this->rule = $rule;
    }

    public function getDiscount(float $amount, int $units): int
    {
        return $this->rule->apply($amount, $units);
    }
}
