<?php
declare(strict_types=1);
namespace koans;
use function PHPUnit\Framework\throwException;

class StringCalculator
{
    public function add(string $inputtedString):string{

        $separatorToComma = str_replace("\n",",",$inputtedString);
        $arrayedString = explode(",",$separatorToComma);
        $errorCheck = $this->errorManagement($arrayedString,$inputtedString);

        if(strcmp($errorCheck[0],"errorMultipleSeparator")==0){
            return "Number expected but '$errorCheck[1]' found at position $errorCheck[2].";
        }

        else if(strcmp($errorCheck[0],"errorEndsWithSeparator")==0) {
            return "Number expected but EOF found.";
        }

        $sumResult = array_sum($arrayedString);
        return "$sumResult";
    }

    private function errorManagement(array $inputtedArray,$inputtedString):array{

        if(array_search("",$inputtedArray)){
            for($i=0;$i<strlen($inputtedString)-1;$i++){
                if(($inputtedString[$i]==',' || $inputtedString[$i]=="\n")&&($inputtedString[$i+1]==',' || $inputtedString[$i+1]=="\n")){
                    $errorResult[0]="errorMultipleSeparator";
                    $errorResult[1] = $inputtedString[$i+1];
                    $errorResult[2] = $i+1;
                    return $errorResult;
                }
            }
            $errorResult[0]="errorEndsWithSeparator";
            return $errorResult;
        }

        else{
            $errorResult[0]="noError";
        }

        return $errorResult;
    }

}