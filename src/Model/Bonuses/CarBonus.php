<?php

namespace Bonuses\Model\Bonuses;

use Bonuses\Model\Employee;
use Bonuses\Model\Money;

/**
 * Applied to employees that have company's car
 */
class CarBonus extends AbstractBonus
{
    private const BONUS = -500;

    public function __construct(Employee $employee)
    {
        parent::__construct($employee);
        $this->value = Money::createFromHumanReadable(self::BONUS);
    }

    public function supports(): bool
    {
        return $this->employee->hasCompanyCar();
    }
}