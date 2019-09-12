<?php

namespace App;

class Helpers
{
    public static function getCategoryFileName($name)
    {
        return $name;
//        $arrName = explode('_', $name);
//        array_shift($arrName);
//        return implode('_', $arrName);
    }

    public static function getCategoryFile($name)
    {
        //return "<img src='/public/category-image/".$name."' alt='".$name."'>";
    }
}
