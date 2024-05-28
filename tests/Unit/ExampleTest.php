<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        //AAA
        //Arrange - Setup
        //Act - Do
        //Assert - Verify
        $this->assertTrue(true);
    }
    public function test_sum_of_two_numbers(): void
    {
        //Arrange
        $a = 5;
        $b = 10;
        //Act
        $sum = $a + $b;
        //Assert
        $this->assertEquals(15, $sum);
    }
}
