<?php

namespace Bonuses\Model\Taxes;

use Bonuses\Model\DeductionSupportInterface;

interface TaxInterface extends DeductionSupportInterface
{
    /**
     * Get fixed value
     *
     * @return float
     */
    public function getValue(): float;
}