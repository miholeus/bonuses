<?php

namespace Bonuses\Model\Bonuses;


use Bonuses\Model\BonusExceptionInterface;

class NotSupportedBonusException extends \RuntimeException implements BonusExceptionInterface
{
    public function __construct($object, \Throwable $previous = null)
    {
        parent::__construct(sprintf("A class must be instance of BonusInterface, but %s given", get_class($object)),
            0, $previous);
    }
}