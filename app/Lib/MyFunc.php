<?php

namespace App\Lib;

class MyFunc 
{
    public static function getUniqueArray($array, $column)
    {   
       $tmp = []; 
       $unique_array = []; 
       foreach ($array as $value){
          if (!in_array($value[$column], $tmp)) {
             $tmp[] = $value[$column];
             $unique_array[] = $value;
          }   
       }   
       return $unique_array;    
    }   
}
