<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Employee
{
    private string $id;
    private string $name;
    private ?Employee $manager;
    private Collection $cars;

    public function __construct(string $name)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->manager = null;
        $this->cars = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getManager(): ?Employee
    {
        return $this->manager;
    }

    public function setManager(?Employee $manager): void
    {
        $this->manager = $manager;
    }

    public function getCars(): ArrayCollection | Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): void
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
        }
    }

    public function removeCar(Car $car): void
    {
        if ($this->cars->contains($car)) {
            $this->cars->removeElement($car);
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'manager' => $this->manager ? $this->manager->toArray() : null,
            'cars' => array_map(function (Car $car): array {
                return $car->toArray();
            }, $this->cars->toArray()),
        ];
    }
}
