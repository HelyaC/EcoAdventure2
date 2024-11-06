<?php

namespace App\Entity;

use App\Repository\BadgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BadgeRepository::class)]
class Badge
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $logoUrl = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, UserBadge>
     */
    #[ORM\ManyToMany(targetEntity: UserBadge::class, inversedBy: 'badges')]
    private Collection $UserBadgeId;

    public function __construct()
    {
        $this->UserBadgeId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(string $logoUrl): static
    {
        $this->logoUrl = $logoUrl;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, UserBadge>
     */
    public function getUserBadgeId(): Collection
    {
        return $this->UserBadgeId;
    }

    public function addUserBadgeId(UserBadge $userBadgeId): static
    {
        if (!$this->UserBadgeId->contains($userBadgeId)) {
            $this->UserBadgeId->add($userBadgeId);
        }

        return $this;
    }

    public function removeUserBadgeId(UserBadge $userBadgeId): static
    {
        $this->UserBadgeId->removeElement($userBadgeId);

        return $this;
    }
}
