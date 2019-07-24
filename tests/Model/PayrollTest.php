<?php
namespace Tests;

use Bonuses\Model\Currency;
use Bonuses\Model\Employee;
use Bonuses\Model\Money;
use Bonuses\Model\Payroll;
use Bonuses\Model\PayrollManager;

class PayrollTest extends \PHPUnit\Framework\TestCase
{
    public function salaryProvider()
    {
        return [
            [
                'Two kids bonus' => [
                    'name' => 'Alice',
                    'salary' => '6000',
                    'currency' => Currency::TYPE_USD,
                    'age' => 26,
                    'kids' => 2,
                    'car' => false
                ],
                'salary' => '4920.00'
            ],
            [
                'Fifty age' => [
                    'name' => 'Bob',
                    'salary' => '4000',
                    'currency' => Currency::TYPE_USD,
                    'age' => 52,
                    'kids' => 0,
                    'car' => false
                ],
                'salary' => '3424.00'
            ],
            [
                'Kids and a car' => [
                    'name' => 'Charlie',
                    'salary' => '5000',
                    'currency' => Currency::TYPE_USD,
                    'age' => 36,
                    'kids' => 3,
                    'car' => true
                ],
                'salary' => '3690.00'
            ]
        ];
    }

    /**
     * @dataProvider salaryProvider
     *
     * @param array $employee
     * @param string $expectedSalary
     * @throws \Exception
     */
    public function testSalaryCalculatedCorrect(array $employee, string $expectedSalary)
    {
        $alice = new Employee($employee['name'], $employee['age'], $employee['kids'], $employee['car']);
        $currency = Currency::fromId($employee['currency']);
        $money = Money::createFromHumanReadable($employee['salary']);
        $payrollManager = new PayrollManager($money, $currency);
        $payroll = new Payroll($payrollManager);
        $this->assertEquals($expectedSalary, $payroll->calculate($alice)->getHumanReadableAmount());
    }
}