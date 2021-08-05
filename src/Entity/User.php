<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class User
{
    private string $id;

    private string $name;

    private string $email;

    private \DateTime $createdOn;

    private \DateTime $updatedOn;

    private Profile $profile;

    private ?Country $country;

    private Collection $phones;

    private Collection $cards;

    public function __construct(string $name, string $email)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->email = $email;
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
        $this->profile = new Profile($this);
        $this->country = null;
        $this->phones = new ArrayCollection();
        $this->cards = new ArrayCollection();
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): void
    {
        $this->country = $country;
    }

    public function getPhones(): ArrayCollection | Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): void
    {
        if (!$this->phones->contains($phone)) {
            $this->phones->add($phone);
        }
    }

    public function removePhone(Phone $phone): void
    {
        if ($this->phones->contains($phone)) {
            $this->phones->removeElement($phone);
        }
    }

    public function getCards(): ArrayCollection | Collection
    {
        return $this->cards;
    }

    public function addCard(Card $card): void
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
        }
    }

    public function removeCard(Card $card): void
    {
        if ($this->cards->contains($card)) {
            $this->cards->removeElement($card);
        }
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdOn' => $this->createdOn->format(\DateTime::RFC3339),
            'updatedOn' => $this->updatedOn->format(\DateTime::RFC3339),
            'profile' => $this->profile->toArray(),
            'country' => $this->country->toArray(),
            'phones' => array_map(function (Phone $phone): array {
                return $phone->toArray();
            }, $this->phones->toArray()),
            'cards' => array_map(function (Card $card): array {
                return $card->toArray();
            }, $this->cards->toArray()),
        ];
    }
}
