<?php

namespace App\Entity;

use App\Repository\UserBadgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserBadgeRepository::class)]
class UserBadge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'userBadges')]
    private Collection $userId;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $challengeDescription = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $earnedAt = null;

    /**
     * @var Collection<int, Badge>
     */
    #[ORM\ManyToMany(targetEntity: Badge::class, mappedBy: 'UserBadgeId')]
    private Collection $badges;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
        $this->badges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(User $userId): static
    {
        if (!$this->userId->contains($userId)) {
            $this->userId->add($userId);
        }

        return $this;
    }

    public function removeUserId(User $userId): static
    {
        $this->userId->removeElement($userId);

        return $this;
    }

    public function getChallengeDescription(): ?string
    {
        return $this->challengeDescription;
    }

    public function setChallengeDescription(?string $challengeDescription): static
    {
        $this->challengeDescription = $challengeDescription;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getEarnedAt(): ?\DateTimeInterface
    {
        return $this->earnedAt;
    }

    public function setEarnedAt(?\DateTimeInterface $earnedAt): static
    {
        $this->earnedAt = $earnedAt;

        return $this;
    }

    /**
     * @return Collection<int, Badge>
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badge $badge): static
    {
        if (!$this->badges->contains($badge)) {
            $this->badges->add($badge);
            $badge->addUserBadgeId($this);
        }

        return $this;
    }

    public function removeBadge(Badge $badge): static
    {
        if ($this->badges->removeElement($badge)) {
            $badge->removeUserBadgeId($this);
        }

        return $this;
    }
}
