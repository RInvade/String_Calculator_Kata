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

        $returnedString = $stringObject->add();

        $this->assertEquals("string", gettype($returnedString));

    }
}
