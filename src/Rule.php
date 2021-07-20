<?php

declare(strict_types=1);

namespace Discount;

abstract class Rule
{
    protected ?Rule $next = null;

    public function chain(Rule $rule): void
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

    abstract protected function isApplicable(float $amount, int $units): bool;

    abstract protected function getResult(): int;
}
