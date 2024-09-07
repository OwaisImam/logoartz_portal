<?php
namespace App\Http;

class Helper {

    public static function getPrefix($nature = 'digitizing', $orderType)
    {
        $prefix = "";

        if($nature === 'digitizing') {
            $prefix .= "D";
        } else if($nature === 'vector') {
            $prefix .="V";
        }

        if(in_array($orderType, [0,5,3,9,7])) {
            $prefix .= 'O';
        } else if(in_array($orderType, [2,8])) {
            $prefix .= 'Q';
        } else if(in_array($orderType, [4])) {
            $prefix .= 'Q';
        } else if(in_array($orderType, [1])) {
            $prefix .= 'O';
        }

        return $prefix;
    } 
}