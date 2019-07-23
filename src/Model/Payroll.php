<?php
namespace Bonuses\Model;

class Payroll
{
    /**
     * @var PayrollManagerInterface
     */
    private $payrollManager;

    public function __construct(PayrollManagerInterface $payrollManager)
    {
        $this->payrollManager = $payrollManager;
    }

    /**
     * Calculate salary for employee
     *
     * @param Employee $employee
     * @return Money
     */
    public function calculate(Employee $employee): Money
    {
        $money = $this->getPayrollManager()->calculate($employee);
        return $money;
    }

    /**
     * @return PayrollManagerInterface
     */
    public function getPayrollManager(): PayrollManagerInterface
    {
        return $this->payrollManager;
    }
}