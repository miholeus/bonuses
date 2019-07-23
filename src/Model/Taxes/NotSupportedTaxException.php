<?php

namespace Bonuses\Model\Taxes;

use Bonuses\Model\BonusExceptionInterface;

class NotSupportedTaxException extends \RuntimeException implements BonusExceptionInterface
{
    public function __construct($object, \Throwable $previous = null)
    {
        parent::__construct(sprintf("A class must be instance of TaxInterface, but %s given", get_class($object)),
            0, $previous);
    }
}