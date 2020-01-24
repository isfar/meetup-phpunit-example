<?php
declare(strict_types=1);

namespace Example;

use Example\Entity\Product;
use Example\Shipping\CostCalculator\CalculatorManager;

class App
{
    private $calculatorManager;

    public function __construct(CalculatorManager $calculatorManager)
    {
        $this->calculatorManager = $calculatorManager;        
    }
    public function execute()
    {
        $strategy = 'pathao';

        $product = new Product(
            '1',
            '5',
            '10',
            '3',
            '2'
        );

        $cost = $this
            ->calculatorManager
            ->get('pathao')
            ->calculate($product);
    }
}

