<?php

namespace Helpers;

class SecurityHelper
{

    public static function getHahedPassword($password)
    {
        $hashedPassword= hash('sha256', $password, FALSE);
        return $hashedPassword;
    }

    public static function check($value, $hashedValue)
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        return (hash('sha256', $value) === $hashedValue);
    }
}