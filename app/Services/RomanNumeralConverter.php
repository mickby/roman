<?php

namespace App\Services;
class RomanNumeralConverter implements IntegerConverterInterface
{
    public function convertInteger(int $integer): string
    {

        // Define the mapping of integers to Roman numerals
        $map = [
            1000 => 'M',
            900  => 'CM',
            500  => 'D',
            400  => 'CD',
            100  => 'C',
            90   => 'XC',
            50   => 'L',
            40   => 'XL',
            10   => 'X',
            9    => 'IX',
            5    => 'V',
            4    => 'IV',
            1    => 'I',
        ];

        $roman = '';

        // Loop through the mapping and build the Roman numeral
        foreach ($map as $value => $symbol) {
            // While the number is greater than or equal to the value
            while ($integer >= $value) {
                $roman .= $symbol; // Append the Roman numeral
                $integer -= $value;    // Decrease the number
            }
        }

        return $roman; // Return the final Roman numeral
    }


}


#todo
/*
 * use interface [x]
 * use REST
 * 3 endpoints
 * 1-3999 [x]
 * most frequently converted
 * last time converted
 *
 * Endpoints
 * int to numeral store numeral
 * list all "recently" converted ints
 * list top 10 converted ints
 * resource for the response
 * validation not in controller
 * clean code
 * check pSR 12
 * php 8.3 features used?
 *
 * short explanation of approach
 * latest features of Laravel
*/
