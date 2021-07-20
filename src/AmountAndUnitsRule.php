<?php

declare(strict_types=1);

namespace Discount;

class AmountAndUnitsRule extends Rule
{
    private int $result;
    private float $minAmount;
    private int $minUnits;

    public function __construct(int $result, float $minAmount, int $minUnits)
    {
        $this->result = $result;
        $this->minAmount = $minAmount;
        $this->minUnits = $minUnits;
    }

    protected function isApplicable(float $amount, int $units): bool
    {
        return $amount > $this->minAmount && $units > $this->minUnits;
    }

    protected function getResult(): int
    {
        return $this->result;
    }
}
