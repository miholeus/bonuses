<?php

namespace Bonuses\Model\Bonuses;

use Bonuses\Model\DeductionSupportInterface;
use Bonuses\Model\Money;

interface BonusInterface extends DeductionSupportInterface
{
    /**
     * Get fixed value
     *
     * @return Money
     */
    public function getValue(): Money;

    /**
     * Check for fixed value
     *
     * @return bool
     */
    public function isBonusByValue():  bool;

    /**
     * Get percent value
     *
     * @return float
     */
    public function getPercentage(): float;

    /**
     * Check for percentage
     *
     * @return bool
     */
    public function isBonusByPercent(): bool;
}