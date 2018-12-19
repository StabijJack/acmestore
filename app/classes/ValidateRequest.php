<?php

namespace App\Classes;
use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    protected static function unique($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            return !Capsule::table($policy)->where($column, '=',$value)->exists();
        }
        return true;
    }
    protected static function required($column, $value, $policy)
    {
        return $value != null && !empty(trim($value));
    }
    public static function minLength($column, $value, $policy)
    {
        return strlen($value) >= $policy;
    }
    public static function maxLength($column, $value, $policy)
    {
        return strlen($value) <= $policy;
    }
}