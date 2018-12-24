<?php

namespace App\Classes;
use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest
{
    private static $error =[];
    private static $error_messages = [
        'string' => 'The attribute field cannot contain numbers', 
        'required' => 'The :attribute field is required', 
        'minLength' => 'The :attribute field must be a minimum of :policy characters', 
        'maxlength' => 'The :attribute field must be a maximum of :policy characters', 
        'mixed' => 'The :attribute field can contain letters, numbers, dash and space only', 
        'number' => 'The :attribute field cannot contain letters e.g. 20.0, 20', 
        'email' => 'Email address is not valid', 
        'unique' => 'That :attribute is already taken, please try another one'
        ];

    public function abide(array $dataAndValues,  array $policies)
    {
        foreach($dataAndValues as $column => $value){
            if (in_array($column,array_keys($policies))) {
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
            $valid = call_user_func_array([self::class, $rule],[$column,$data['value'],$policy]);
            if(!$valid){
                self::setError(
                    str_replace(
                        [':attribute', ':policy', '_'],
                        [$column, $policy, ' '],
                        self::$error_messages[$rule]
                    ),
                    $column
                );
            }
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
            if(!preg_match('/^[A-Za-z0-9 .,_~\-!@#\&%\^\'\*\(\)]+$/', $value)){
                return false;
            }
        }
        return true;
    }
    protected static function string($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            if(!preg_match('/^[A-Za-z ]+$/', $value)){
                return false;
            }
        }
        return true;
    }
    protected static function number($column, $value, $policy)
    {
        if ($value != null && !empty(trim($value))) {
            if(!preg_match('/^[0-9.,]+$/', $value)){
                return false;
            }
        }
        return true;
    }
    private static function setError($error, $key = null){
        if($key){
            self::$error[$key][] = $error;
        }
        else{
            self::$error[]=$error;
        }
    }
    public function hasError()
    {
        return count(self::$error) > 0 ? true : false;
    }
    public function getErrorMessages()
    {
        return self::$error;
    }
}