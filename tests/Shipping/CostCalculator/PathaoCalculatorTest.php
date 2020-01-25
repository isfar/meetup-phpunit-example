<?php
declare(strict_types=1);

namespace Example\Tests\Shipping\CostCalculator;

use Example\Entity\Product;
use Example\Shipping\CostCalculator\CalculatorException;
use Example\Shipping\CostCalculator\PathaoCalculator;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class PathaoCalculatorTest extends TestCase
{
    public function testCalculateWhenClientReturnsValidResponse(): void
    {
        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('{"cost": "45.874"}')
        ;

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->willReturn($response)
        ;

        $calculator = new PathaoCalculator($httpClient);

        $product = new Product('4', '1.5', '5', '4', '2');

        $output = $calculator->calculate($product);
        
        $expected = '45.87';

        $this->assertSame($expected, $output);
    }

    public function testCalculateThrowsException(): void
    {
        $this->expectException(CalculatorException::class);

        $guzzleException = $this->createMock(GuzzleException::class);

        $httpClient = $this->createMock(ClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->willThrowException($guzzleException)
        ;

        $product = new Product('4', '1');

        $calculator = new PathaoCalculator($httpClient);
        
        $calculator->calculate($product);
    }
}

