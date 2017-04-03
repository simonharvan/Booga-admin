<?php namespace App\Models\Core;

use ReflectionClass;

abstract class Enum
{
    private static $constCacheArray = null;
    
    public static function getKeys()
    {
        $class = new ReflectionClass(get_called_class());
        
        return array_keys($class->getConstants());
    }
    
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();
        
        if ($strict) {
            return array_key_exists($name, $constants);
        }
        
        $keys = array_map('strtolower', array_keys($constants));
        
        return in_array(strtolower($name), $keys, $strict);
    }
    
    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getConstants());
        
        return in_array($value, $values, $strict);
    }
    
    private static function getConstants()
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        
        return self::$constCacheArray[$calledClass];
    }
}