<?php

namespace App\Services;
class RomanNumeralConverter implements IntegerConverterInterface
{
    public function convertInteger(int $integer): string
    {

        return "string";
    }

}


#todo
/*
 * use interface [x]
 * use REST
 * 3 endpoints
 * 1-3999
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
