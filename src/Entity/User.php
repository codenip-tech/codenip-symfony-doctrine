<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class User
{
    private string $id;
    private string $name;
    private string $email;
    private \DateTime $createdOn;
    private \DateTime $updatedOn;
    private Profile $profile;

    public function __construct(string $name, string $email)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->email = $email;
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
        $this->profile = new Profile($this);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }

    public function getUpdatedOn(): \DateTime
    {
        return $this->updatedOn;
    }

    public function markAsUpdated(): void
    {
        $this->updatedOn = new \DateTime();
    }

    public function getProfile(): Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdOn' => $this->createdOn->format(\DateTime::RFC3339),
            'updatedOn' => $this->updatedOn->format(\DateTime::RFC3339),
            'profile' => [
                'id' => $this->profile->getId(),
                'pictureUrl' => $this->profile->getPictureUrl(),
            ],
        ];
    }
}
