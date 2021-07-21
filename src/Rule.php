<?php

declare(strict_types=1);

namespace Discount;

class Rule
{
    private int $result;
    private float $minAmount;
    private int $minUnits;
    private ?self $next = null;

    public function __construct(int $result, float $minAmount, int $minUnits)
    {
        $this->result = $result;
        $this->minAmount = $minAmount;
        $this->minUnits = $minUnits;
    }

    public function chain(self $rule): void
    {
        if ($this->next) {
            $this->next->chain($rule);
        } else {
            $this->next = $rule;
        }
    }

    public function apply(float $amount, int $units): int
    {
        if ($this->isApplicable($amount, $units)) {
            return $this->getResult();
        }
        return $this->next ? $this->next->apply($amount, $units) : 0;
    }

    private function isApplicable(float $amount, int $units): bool
    {
        return $amount > $this->minAmount && $units > $this->minUnits;
    }

    private function getResult(): int
    {
        return $this->result;
    }
}
