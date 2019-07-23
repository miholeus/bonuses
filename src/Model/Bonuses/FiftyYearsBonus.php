<?php
namespace Bonuses\Model\Bonuses;

class FiftyYearsBonus extends AbstractBonus
{
    private const YEARS = 50;

    protected $percentage = 7;

    public function supports(): bool
    {
        return $this->employee->getAge() >= self::YEARS;
    }
}