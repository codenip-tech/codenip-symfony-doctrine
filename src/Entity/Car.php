<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Car
{
    private string $id;
    private string $brand;
    private string $model;
    private Employee $owner;

    public function __construct(string $brand, string $model, Employee $owner)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->brand = $brand;
        $this->model = $model;
        $this->owner = $owner;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getOwner(): Employee
    {
        return $this->owner;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
        ];
    }
}
