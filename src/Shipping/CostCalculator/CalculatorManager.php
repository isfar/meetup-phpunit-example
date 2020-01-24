<?php
declare(strict_types=1);

namespace Example\Shipping\CostCalculator;

class CalculatorManager
{
    private $strategies;

    public function __construct()
    {
        $this->strategies = [];
    }

    public function add(string $key, CalculatorInterface $calculator): self
    {
        $this->strategies[$key] = $calculator;

        return $this;
    }

    public function get(string $key): CalculatorInterface
    {
        if (!isset($this->strategies[$key])) {
            throw new CalculatorException('No calculator strategy registered with the key: "' . $key . '"');
        }

        return $this->strategies[$key];
    }
}