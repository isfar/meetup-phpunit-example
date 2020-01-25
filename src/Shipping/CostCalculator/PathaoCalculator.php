<?php
declare(strict_types=1);

namespace Example\Shipping\CostCalculator;

use Example\Entity\Product;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class PathaoCalculator implements CalculatorInterface
{
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    
    /**
     * @param Product $product
     * 
     * @return string
     *
     * @throws CalculatorException
     */ 
    public function calculate(Product $product): string
    {
        try {
            $response = $this
                ->httpClient
                ->request(
                    'post',
                    'https://shipping.pathao.com/cost-calculator',
                    [
                        'query' => [
                            'weight' => $product->getWeight(),
                            'length' => $product->getLength(),
                            'width' => $product->getWidth(),
                            'height' => $product->getHeight(),
                        ],
                    ]
                )
            ;

        } catch (GuzzleException $guzzleException) {
            throw new CalculatorException('Error calculating cost: ' . $guzzleException->getMessage());
        }

        $json = json_decode($response->getBody(), true);

        return bcmul($json['cost'], '1', 2);
    }
}