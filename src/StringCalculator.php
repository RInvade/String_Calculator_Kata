<?php
declare(strict_types=1);
namespace koans;
class StringCalculator
{
    public function add(string $inputtedString):string
    {
        $separatorToComma = str_replace("\n",",",$inputtedString);
        $arrayedString = explode(",",$separatorToComma);
        $sumResult = array_sum($arrayedString);
        return "$sumResult";
    }

}