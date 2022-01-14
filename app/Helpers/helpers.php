<?php

use Illuminate\Support\Arr;

if (! function_exists('moneyFormat')) {    
    /**
     * moneyFormat
     *
     * @param  mixed $str
     * @return void
     */
    function moneyFormat($str) {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}

if (! function_exists('array_except')) {
    /**
     * Get all of the given array except for a specified array of items.
     *
     * @param  array  $array
     * @param  array|string  $keys
     * @return array
     */
    function array_except($array, $keys)
    {
        return Arr::except($array, $keys);
    }
}