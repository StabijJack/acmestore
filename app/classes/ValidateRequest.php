<?php

namespace App\Classes;
use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    public function abide(array $dataAndValues,  array $policies)
    {
        foreach($dataAndValues as $column => $value){
            if (in_array($column,arraykeys($policies))) {
                self::doValidation(
                    ['column' => $column, 'value' => $value, 'policies' => $policies[$column]]
                );
            }
        }   
    }
    private static function doValidation(array $data)
    {
        $column = $data['column'];
        foreach($data['policies'] as $rule => $policy){
            $valid = call_user_func_array([self::class, $rule],$column,$data['value'],$policy);

        }

    }
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
    protected static function minLength($column, $value, $policy)
    {
        return strlen($value) >= $policy;
    }
    protected static function maxLength($column, $value, $policy)
    {
        return strlen($value) <= $policy;
    }
    protected static function email($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }
    }
    protected static function mixed($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            if(!preg_match('/^[A-Za-z0-9 .,_~\-!@#&%\^\'\*\(\)]+$/', $value)){
                return true;
            }
        }
        return false;
    }
    protected static function string($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            if(!preg_match('/^[A-Za-z ]+$/', $value)){
                return true;
            }
        }
        return false;
    }
    protected static function number($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            if(!preg_match('/^[0-9.,]+$/', $value)){
                return true;
            }
        }
        return false;
    }
}