<?php
declare(strict_types=1);
namespace koans;

class StringCalculator
{
    public function add(string $inputtedString):string{


        if(!strcmp($inputtedString,"")==0){
            $newSeparator = $this->readNewSeparator($inputtedString);
            if(!strcmp($newSeparator[0],"")==0){
                $inputtedString=substr($inputtedString,$newSeparator[1]+3);
                $arrayedString = explode($newSeparator[0],$inputtedString);
            }
            else{
                $separatorToComma = str_replace("\n",",",$inputtedString);
                $arrayedString = explode(",",$separatorToComma);
            }

        }
        else{
            $newSeparator="";
            $separatorToComma = str_replace("\n",",",$inputtedString);
            $arrayedString = explode(",",$separatorToComma);
        }

        $errorCheck = $this->errorManagement($arrayedString,$inputtedString,$newSeparator);
        $errorMsg="";
        if(str_contains($errorCheck[0],"negativeError")){
            $errorMsg=$this->addErrorMsg($errorMsg,"Negative not allowed : $errorCheck[4]");
            return $errorMsg;
        }

        else if(str_contains($errorCheck[0],"errorMultipleSeparator")){
            $errorMsg=$this->addErrorMsg($errorMsg,"Number expected but '$errorCheck[1]' found at position $errorCheck[2].");
        }

        else if(str_contains($errorCheck[0],"errorEndsWithSeparator")) {
            $errorMsg=$this->addErrorMsg($errorMsg,"Number expected but EOF found.");
        }
        if(strcmp($errorMsg,"")){
            return $errorMsg;
        }

        $sumResult = array_sum($arrayedString);
        return "$sumResult";
    }

    private function errorManagement(array $inputtedArray,$inputtedString,$newSeparator):array{
        $errorResult[0] ="";
         if(array_search("",$inputtedArray)){
            for($i=0;$i<strlen($inputtedString)-1;$i++){
                if(($inputtedString[$i]==',' || $inputtedString[$i]=="\n" || $inputtedString[$i]==$newSeparator)&&($inputtedString[$i+1]==',' || $inputtedString[$i+1]=="\n" || $inputtedString[$i+1]==$newSeparator)){
                    $errorResult[0]=$errorResult[0]." errorMultipleSeparator";
                    $errorResult[1] = $inputtedString[$i+1];
                    $errorResult[2] = $i+1;
                }
            }
            if($i>=strlen($inputtedString)-1) {
                $errorResult[0] = $errorResult[0] ." errorEndsWithSeparator";
            }
        }

         else  if($inputtedString==""){
             $errorResult[0]="noError";
         }

         else if(!empty($this->negativeNumbers($inputtedArray))){
             $errorResult[0]=$errorResult[0]." negativeError";
             $errorResult[4]=implode(", ",$this->negativeNumbers($inputtedArray));
         }

         return $errorResult;
    }

    private function negativeNumbers(array $inputtedArray):array{

        return array_filter($inputtedArray, function($arrayVal){
            return $arrayVal<0;
        });

    }

    public function readNewSeparator(string $inputtedString):array{
        if($inputtedString[0]=="/"){
            $endPosition=strpos($inputtedString,"\n");
            $separator[0] =substr($inputtedString,2,$endPosition-2);
            $separator[1] = $endPosition-2;
            return $separator;
        }
        $result[0]="";
        return $result;
    }

    private function addErrorMsg(string $errorString,string $newError):string{
        if(empty($errorString)){
            return "$newError";
        }
        else{
            return $errorString."\n".$newError;
        }
    }
}
