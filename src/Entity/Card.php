<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Card
{
    private string $id;
    private string $value;

    public function __construct(string $value)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->value = $value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
        ];
    }
}
