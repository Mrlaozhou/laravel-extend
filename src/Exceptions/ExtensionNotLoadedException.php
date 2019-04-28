<?php
namespace Mrlaozhou\Extend\Exceptions;

use Throwable;

class ExtensionNotLoadedException extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct("PHP extension [{$name}] not loaded .", $code, $previous);
    }
}