<?php

namespace Bonuses\Model\Taxes;

/**
 * Decrease tax for an employee with 2 kids
 */
class TwoKidsTax extends AbstractTax
{
    private const KIDS_NUMBER = 2;

    protected $value = -2;

    public function supports(): bool
    {
        return $this->employee->getKids() >= self::KIDS_NUMBER;
    }
}