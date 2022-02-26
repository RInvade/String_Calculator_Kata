<?php

declare(strict_types=1);

namespace koans\Test;

use koans\Variables;
use PHPUnit\Framework\TestCase;

final class VariablesTest extends TestCase
{
    /**
     * @test
     */
    public function adds_two_values()
    {
        $variables = new Variables();

        $addedValues = $variables->addTwoValues(2, 2);

        $this->assertEquals(4, $addedValues);
    }
}
