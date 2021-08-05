<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Card
{
    private string $id;
    private string $value;
    private Collection $users;

    public function __construct(string $value)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->value = $value;
        $this->users = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getUsers(): ArrayCollection|Collection
    {
        return $this->users;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'users' => array_map(function (User $user): array {
                return [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                ];
            }, $this->users->toArray())
        ];
    }
}
