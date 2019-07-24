<?php

namespace Bonuses\Command;

use Bonuses\Model\Currency;
use Bonuses\Model\Employee;
use Bonuses\Model\Money;
use Bonuses\Model\Payroll;
use Bonuses\Model\PayrollManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class CalculateSalaryCommand extends Command
{
    protected function configure()
    {
        $this->setName('salary:calc')
            ->addArgument('name', InputArgument::REQUIRED, 'Employee\'s name')
            ->addOption('salary', null,
                InputOption::VALUE_REQUIRED, 'Employee\'s salary')
            ->addOption('age', null, InputOption::VALUE_REQUIRED, 'Employee\'s age')
            ->addOption('currency', null,
                InputOption::VALUE_REQUIRED, 'Currency for salary',
                'USD')
            ->addOption('kids', null,
                InputOption::VALUE_REQUIRED, 'Has employee kids?', 0)
            ->addOption('car', null,
                InputOption::VALUE_REQUIRED, 'Has employee company car?', 0);
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $salary = $input->getOption('salary');
        if (!is_numeric($salary)) {
            throw new \RuntimeException("Salary is invalid");
        }
        $age = $input->getOption('age');
        if (!is_numeric($age)) {
            throw new \RuntimeException("Age is invalid");
        }
        $kids = $input->getOption('kids');
        if (!is_numeric($kids)) {
            throw new \RuntimeException("Kids param should be positive number");
        }
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $age = $input->getOption('age');
        $kids = $input->getOption('kids');
        $car = boolval($input->getOption('car'));
        $currency = $input->getOption('currency');
        $salary = $input->getOption('salary');

        $alice = new Employee($name, $age, $kids, $car);
        try {
            $currency = Currency::fromName($currency);
            $money = Money::createFromHumanReadable($salary);
            $payrollManager = new PayrollManager($money, $currency);
            $payroll = new Payroll($payrollManager);
            $output->writeln(sprintf('Total salary is %s', $currency->formatMoney($payroll->calculate($alice))));
        } catch (\Throwable $e) {
            $output->writeln(sprintf("<error>%s</error>", $e->getMessage()));
        }
    }
}