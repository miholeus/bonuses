<?php

namespace Bonuses\Model;


class Money
{
    const DEFAULT_PRECISION = 2; // precision for money

    protected $amount = 0;

    protected $precision = Money::DEFAULT_PRECISION;

    private function __construct(){}// disable direct invocation

    /**
     * Create money from storable amount
     *
     * @param int $amount
     * @return Money
     */
    public static function createFromStorable(int $amount): Money
    {
        $money = new self();
        $money->amount = (int) $amount;

        return $money;
    }

    /**
     * Creates from human readable format
     *
     * @param $amount
     * @return Money
     */
    public static function createFromHumanReadable($amount): Money
    {
        $money = new self();
        $money->amount = number_format($amount, $money->precision, '', '');

        return $money;
    }

    /**
     * Precision
     *
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }

    /**
     * Storable amount
     *
     * @return int
     */
    public function getStorableAmount(): int
    {
        return (int) $this->amount;
    }

    /**
     * Human readable formatted string
     *
     * @return string
     */
    public function getHumanReadableAmount(): string
    {
        return number_format($this->amount / pow(10, $this->precision), $this->precision, '.', '');
    }

    /**
     * Add money
     *
     * @param Money $money
     * @return Money
     */
    public function add(Money $money): Money
    {
        return self::createFromStorable($this->getStorableAmount() + $money->getStorableAmount());
    }

    /**
     * Subtract money
     *
     * @param Money $money
     * @return Money
     */
    public function sub(Money $money): Money
    {
        return self::createFromStorable($this->getStorableAmount() - $money->getStorableAmount());
    }
}