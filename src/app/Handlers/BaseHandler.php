<?php

namespace App\Handlers;

abstract class BaseHandler
{
    private $typeName;

    public function __construct($typeName)
    {
        $this->typeName = $typeName;
    }

    public function isMatch(string $type): bool
    {
        return ($type === $this->typeName);
    }

    public function isValidAge($age): bool
    {
        if ($age <= 18 || $age >= 65) {
            return false;
        }

        return true;
    }

    public function isValidCardNumber($cardNumber): bool
    {
        if (preg_match('/(\w)\1{2,}/', $cardNumber)) {
            return true;
        }

        return false;
    }
}
