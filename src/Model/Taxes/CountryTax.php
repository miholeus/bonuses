<?php

namespace Bonuses\Model\Taxes;

class CountryTax extends AbstractTax
{
    protected $value = 20;// country tax value

    public function supports(): bool
    {
        return true;// available for all employees
    }
}