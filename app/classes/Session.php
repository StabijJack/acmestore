<?php

namespace App\Classes;

class Session
{
    //create session
    public static function add($name, $value)
    {
        if($name != '' && !empty($name) && $value != '' && !empty($value)){
            return $_SESSION[$name] = $value;
        }
        throw new \Exception('Name and Value required');
    }

    //get value from session
    public static function get($name){
        return $_SESSION[$name];
    }

    //check if sessio exists
    public static function has($name){
        if($name != '' && !empty($name)){
            return (isset($_SESSION[$name])) ?  true : false;
        }
        throw new \Exception('Name is required');

    }
    //remove session
    public static function remove($name){
        if(self::has($name)){
            unset($_SESSION[$name]);
        }
    }

}