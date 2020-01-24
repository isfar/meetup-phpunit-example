<?php
declare(strict_types=1);

namespace Example\Shipping\CostCalculator;

use Example\Entity\Product;

class WeightCalculator implements CalculatorInterface
{
    private $rate;

    public function __construct(string $rate)
    {
        $this->rate = $rate;
    }

    public function calculate(Product $product): string
    {
        return bcmul(
            $product->getWeight(),
            $this->rate,
            2
        );
    }
} 