<?php

namespace Bonuses\Model;


interface DeductionSupportInterface
{
    /**
     * Check if bonus/tax is valid for employee
     *
     * @return bool
     */
    public function supports(): bool;
}