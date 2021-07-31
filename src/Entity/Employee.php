<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Employee
{
    private string $id;
    private string $name;
    private ?Employee $manager;

    public function __construct(string $name)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->manager = null;
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'manager' => $this->manager ? $this->manager->toArray() : null,
        ];
    }
}
