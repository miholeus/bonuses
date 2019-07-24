<?php
namespace Bonuses\Model;

class Employee
{
    /**
     * Name
     *
     * @var string
     */
    private $name;
    /**
     * Age
     *
     * @var int
     */
    private $age;
    /**
     * Number of kids
     *
     * @var int
     */
    private $kids;
    /**
     * Has company car?
     *
     * @var bool
     */
    private $companyCar;

    /**
     * @var Money
     */
    private $salary;

    public function __construct(string $name, int $age, int $kids = 0, bool $companyCar = false)
    {
        if ($kids < 0) {
            throw new \LogicException("Employee can't have negative kids number");
        }
        $this->name = $name;
        $this->age = $age;
        $this->kids = $kids;
        $this->companyCar = $companyCar;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return int
     */
    public function getKids(): int
    {
        return $this->kids;
    }

    /**
     * @return bool
     */
    public function hasCompanyCar(): bool
    {
        return $this->companyCar;
    }


    /**
     * @return Money
     */
    public function getSalary(): Money
    {
        return $this->salary;
    }

    /**
     * @param Money $salary
     */
    public function setSalary(Money $salary): void
    {
        $this->salary = $salary;
    }
}