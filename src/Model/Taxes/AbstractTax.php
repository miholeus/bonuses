<?php

namespace Bonuses\Model\Taxes;

use Bonuses\Model\Employee;

abstract class AbstractTax implements TaxInterface
{
    /**
     * Tax percentage value
     *
     * @var float
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

    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Available tax?
     *
     * @return bool
     */
    public function isTaxAvailable(): bool
    {
        return null !== $this->value;
    }

    abstract public function supports(): bool;
}