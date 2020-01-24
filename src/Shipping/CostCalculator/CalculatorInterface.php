<?php
declare(strict_types=1);

namespace Example\Shipping\CostCalculator;

use Example\Entity\Product;

interface CalculatorInterface
{
    public function calculate(Product $product): string;
}