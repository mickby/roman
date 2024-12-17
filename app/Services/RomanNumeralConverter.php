<?php

namespace App\Services;

use App\Services\IntegerConverterInterface;

class RomanNumeralConverter implements IntegerConverterInterface
{
    /**
     * Convert an integer to its Roman numeral representation.
     *
     * @param int $integer The integer to convert.
     * @return string The Roman numeral representation of the integer.
     */
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
                $integer -= $value; // Decrease the number
            }
        }

        return $roman;
    }
}
