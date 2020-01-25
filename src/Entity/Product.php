<?php
declare(strict_types=1);

namespace Example\Entity;

class Product
{
    private $id;
    private $weight;
    private $length;
    private $width;
    private $height;


    public function __construct(
        string $id,
        string $weight,
        ?string $length = null,
        ?string $width = null,
        ?string $height = null
    ) {
        $this->id = $id;
        $this->weight = $weight;
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function getWidth(): ?string
    {
        return $this->width;
    }
}