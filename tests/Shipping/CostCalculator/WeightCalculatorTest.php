<?php
declare(strict_types=1);

namespace Example\Tests\Shipping\CostCalculator;

use Example\Entity\Product;
use Example\Shipping\CostCalculator\WeightCalculator;
use PHPUnit\Framework\TestCase;

class WeightCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new WeightCalculator('2');

        $product = new Product('1', '5.20', '1', '1', '1');

        $output = $calculator->calculate($product);

        $expected = '10.40';

        $this->assertSame($expected, $output, 'Weight based cost calculation failed');
    }
}
