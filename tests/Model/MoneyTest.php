<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonuses\Model\Money;

class MoneyTest extends TestCase
{
    public function testThatHumanReadableAmountIsSavedCorrect()
    {
        $money = Money::createFromHumanReadable(100);
        $this->assertEquals("100.00", $money->getHumanReadableAmount());
    }

    public function testThatHumanReadableAmountIsValidStorableAmount()
    {
        $money = Money::createFromHumanReadable(100);
        $this->assertEquals(10000, $money->getStorableAmount());
    }

    public function testThatMoneyCreatedFromStorableIsCorrect()
    {
        $money = Money::createFromStorable(10000);
        $this->assertEquals(10000, $money->getStorableAmount());
    }

    public function testThatMoneyCreatedFromStorableIsValidHumanReadableAmount()
    {
        $money = Money::createFromStorable(10000);
        $this->assertEquals("100.00", $money->getHumanReadableAmount());
    }

    public function testAddMoneyReturnsMoneyInstance()
    {
        $money = Money::createFromStorable(10000);
        $new = $money->add(Money::createFromStorable(10000));
        $this->assertInstanceOf(Money::class, $new);
    }

    public function testAddMoneyReturnsValidAmount()
    {
        $money = Money::createFromStorable(10000);
        $new = $money->add(Money::createFromStorable(10000));
        $this->assertEquals(20000, $new->getStorableAmount());
    }

    public function testSubMoneyReturnsMoneyInstance()
    {
        $money = Money::createFromStorable(20000);
        $new = $money->sub(Money::createFromStorable(10000));
        $this->assertInstanceOf(Money::class, $new);
    }

    public function testSubMoneyReturnsValidAmount()
    {
        $money = Money::createFromStorable(20000);
        $new = $money->sub(Money::createFromStorable(10000));
        $this->assertEquals(10000, $new->getStorableAmount());
    }
}