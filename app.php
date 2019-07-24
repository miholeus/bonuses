<?php

require __DIR__.'/vendor/autoload.php';

use Bonuses\Command\CalculateSalaryCommand;
use Symfony\Component\Console\Application;

$application = new Application('calc', '1.0.0');
$command = new CalculateSalaryCommand();

$application->add($command);

$application->setDefaultCommand($command->getName(), true);
$application->run();
