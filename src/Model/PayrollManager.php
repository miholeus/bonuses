<?php

namespace Bonuses\Model;

use Bonuses\Model\Bonuses\BonusInterface;
use Bonuses\Model\Bonuses\CarBonus;
use Bonuses\Model\Bonuses\FiftyYearsBonus;
use Bonuses\Model\Bonuses\NotSupportedBonusException;
use Bonuses\Model\Taxes\CountryTax;
use Bonuses\Model\Taxes\NotSupportedTaxException;
use Bonuses\Model\Taxes\TaxInterface;
use Bonuses\Model\Taxes\TwoKidsTax;

class PayrollManager implements PayrollManagerInterface
{
    /**
     * Available taxes
     *
     * @var array
     */
    protected $availableTaxes = [CountryTax::class, TwoKidsTax::class];
    /**
     * Available bonuses
     *
     * @var array
     */
    protected $availableBonuses = [CarBonus::class, FiftyYearsBonus::class];

    /**
     * Total amount that will be added to salary
     *
     * @var
     */
    protected $amount;
    /**
     * @var Money
     */
    protected $salary;
    /**
     * @var Currency
     */
    private $currency;

    public function __construct(Money $salary, Currency $currency)
    {
        $this->salary = $salary;
        $this->currency = $currency;
    }

    /**
     * Apply taxes for employee
     * @param Money $money
     * @param Employee $employee
     *
     * @return Money
     */
    protected function applyTaxes(Money $money, Employee $employee): Money
    {
        $taxes = 0;// value in percents
        foreach ($this->availableTaxes as $taxClass) {
            /** @var TaxInterface $tax */
            $tax = new $taxClass($employee);
            if (!$tax instanceof TaxInterface) {
                throw new NotSupportedTaxException($tax);
            }
            if ($tax->supports()) {
                $taxes += $tax->getValue();
            }
        }

        return $this->applyPercentToMoney($money, -$taxes);// we subtract from given money
    }

    /**
     * Apply bonuses for employee
     * @param Money $money
     * @param Employee $employee
     *
     * @return Money
     */
    protected function applyBonuses(Money $money, Employee $employee): Money
    {
        foreach ($this->availableBonuses as $bonusClass) {
            /** @var BonusInterface $bonus */
            $bonus = new $bonusClass($employee);
            if (!$bonus instanceof BonusInterface) {
                throw new NotSupportedBonusException($bonus);
            }
            if ($bonus->supports()) {
                if ($bonus->isBonusByValue()) {
                    $money = $money->add($bonus->getValue());
                } elseif ($bonus->isBonusByPercent()) {
                    $money = $this->applyPercentToMoney($money, $bonus->getPercentage());
                }
            }
        }

        return $money;
    }

    /**
     * Calculate percents
     *
     * @param Money $money
     * @param float $percentage
     * @return Money
     */
    protected function applyPercentToMoney(Money $money, float $percentage): Money
    {
        $amount = $money->getStorableAmount();
        /*
         * everything less than 1 cent is removed
         * for more precision, just simply increase "precision" in money
         */
        $value = intval($percentage*100*$amount/10000);
        return Money::createFromStorable($value + $amount);
    }

    /**
     * @return Money
     */
    public function getSalary(): Money
    {
        return $this->salary;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Calculate salary
     *
     * @param Employee $employee
     * @return Money|mixed
     */
    public function calculate(Employee $employee)
    {
        $amount = $this->getSalary();
        $amount = $this->applyBonuses($amount, $employee);
        $amount = $this->applyTaxes($amount, $employee);

        return $amount;
    }
}