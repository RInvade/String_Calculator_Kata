<?php

declare(strict_types=1);
namespace koans\Test;
use koans\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function given_string_returns_a_string(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("");

        $this->assertEquals("string", gettype($returnedString));

    }

    /**
     * @test
     */
    public function given_empty_string_returns_0(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("");

        $this->assertEquals("0",$returnedString);
    }

    /**
     * @test
     */
    public function given_1_2_with_comma_separator_returns_3(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("1,3");

        $this->assertEquals("4",$returnedString);
    }

    /**
     * @test
     */
    public function handle_sum_with_newline_as_separator(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("1\n2,3");

        $this->assertEquals("6",$returnedString);
    }

    /**
     * @test
     */
    public function given_multiple_separator_return_error(){

        $stringObject =new StringCalculator();

        $returnedString = $stringObject->add("175.2\n,35");

        $this->assertEquals("Number expected but ',' found at position 6.",$returnedString);
    }

    /**
     * @test
     */
    public function given_separator_at_the_end_returns_error(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("1,3,");

        $this->assertEquals("Number expected but EOF found.",$returnedString);
    }

    /**
     * @test
     */
    public function given_negative_numbers_returns_error(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("2,-4,-5");

        $this->assertEquals("Negative not allowed : -4, -5",$returnedString);
    }


    /**
     * @test
     */
    public function given_custom_separator_operates_with_it(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("//:\n1:2");

        $this->assertEquals("3",$returnedString);
    }
    /**
     * @test
     */
    public function given_long_custom_separator_operates_with_it(){

        $stringObject = new StringCalculator();

        $returnedString = $stringObject->add("//exp\n2exp3");

        $this->assertEquals("5",$returnedString);
    }


}
