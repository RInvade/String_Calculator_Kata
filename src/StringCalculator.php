<?php
declare(strict_types=1);
namespace koans;
class StringCalculator
{
    public function add(string $inputtedString):string
    {
        $arrayedString = explode(",",$inputtedString);
        $sumResult = array_sum($arrayedString);
        return "$sumResult";
    }

}