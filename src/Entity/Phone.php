<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Phone
{
    private string $id;
    private string $number;

    public function __construct(string $number)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->number = $number;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
        ];
    }
}
