<?php

namespace Bonuses\Model\Bonuses;


use Bonuses\Model\Employee;
use Bonuses\Model\Money;

abstract class AbstractBonus implements BonusInterface
{
    /**
     * @var float
     */
    protected $percentage;
    /**
     * @var Money
     */
    protected $value;
    /**
     * @var Employee
     */
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
    /**
     * Get percentage
     *
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * Check for percentage
     *
     * @return bool
     */
    public function isBonusByPercent(): bool
    {
        return null !== $this->percentage;
    }

    /**
     * Get bonus value
     *
     * @return Money
     */
    public function getValue(): Money
    {
        return $this->value;
    }

    /**
     * Check for fixed value
     *
     * @return bool
     */
    public function isBonusByValue():  bool
    {
        return null !== $this->value;
    }

    abstract public function supports(): bool;
}