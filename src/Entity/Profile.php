<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Profile
{
    private string $id;
    private ?string $pictureUrl;
    private User $user;

    public function __construct(User $user)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->pictureUrl = null;
        $this->user = $user;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPictureUrl(): ?string
    {
        return $this->pictureUrl;
    }

    public function setPictureUrl(?string $pictureUrl): void
    {
        $this->pictureUrl = $pictureUrl;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'pictureUrl' => $this->pictureUrl,
            'user' => [
                'id' => $this->user->getId(),
            ],
        ];
    }
}
