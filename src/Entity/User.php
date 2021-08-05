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

    private Collection $friendsWithMe;

    private Collection $myFriends;

    private int $score;

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
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
        $this->score = 0;
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

    /**
     * @return ArrayCollection|Collection
     */
    public function getFriendsWithMe(): ArrayCollection | Collection
    {
        return $this->friendsWithMe;
    }

    public function addFriendWithMe(User $friendWithMe): void
    {
        if (!$this->friendsWithMe->contains($friendWithMe)) {
            $this->friendsWithMe->add($friendWithMe);
        }
    }

    public function removeFriendWithMe(User $friendWithMe): void
    {
        if ($this->friendsWithMe->contains($friendWithMe)) {
            $this->friendsWithMe->removeElement($friendWithMe);
        }
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getMyFriends(): ArrayCollection | Collection
    {
        return $this->myFriends;
    }

    public function addMyFriend(User $friend): void
    {
        if (!$this->myFriends->contains($friend)) {
            $this->myFriends->add($friend);
        }
    }

    public function removeMyFriend(User $friend): void
    {
        if ($this->myFriends->contains($friend)) {
            $this->myFriends->removeElement($friend);
        }
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function updateScore(): void
    {
        ++$this->score;
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
            'friends' => array_map(function (User $user): array {
                return [
                    'type' => 'my friends',
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                ];
            }, $this->myFriends->toArray()),
            'friendsWithMe' => array_map(function (User $user): array {
                return [
                    'type' => 'friends with me',
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                ];
            }, $this->friendsWithMe->toArray()),
        ];
    }
}
