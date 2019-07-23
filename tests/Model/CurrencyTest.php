<?php

namespace Tests;


use Bonuses\Model\Currency;
use Bonuses\Model\Money;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function testMoneyIsFormattedWithCurrency()
    {
        $usd = Currency::fromId(Currency::TYPE_USD);
        $money = Money::createFromStorable(10000);
        $this->assertEquals("$100,00", $usd->formatMoney($money));
    }
}