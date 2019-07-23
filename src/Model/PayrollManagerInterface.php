<?php

namespace Bonuses\Model;

interface PayrollManagerInterface
{
    /**
     * Return money instance
     *
     * @return Money
     */
    public function getSalary(): Money;

    /**
     * Return currency instance
     *
     * @return Currency
     */
    public function getCurrency(): Currency;

    /**
     * Calculate salary for employee
     *
     * @param Employee $employee
     * @return mixed
     */
    public function calculate(Employee $employee);
}