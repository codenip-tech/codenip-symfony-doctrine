<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Country
{
    private string $id;
    private string $name;

    public function __construct(string $name)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
