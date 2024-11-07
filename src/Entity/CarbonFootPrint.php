<?php

namespace App\Entity;

use App\Repository\CarbonFootPrintRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarbonFootPrintRepository::class)]
class CarbonFootPrint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

   

    #[ORM\Column(nullable: true)]
    private ?float $footPrintScore = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $calculated = null;

    #[ORM\ManyToOne(inversedBy: 'carbonFootPrints')]
    private ?User $userId = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getFootPrintScore(): ?float
    {
        return $this->footPrintScore;
    }

    public function setFootPrintScore(?float $footPrintScore): static
    {
        $this->footPrintScore = $footPrintScore;

        return $this;
    }

    public function getCalculated(): ?\DateTimeInterface
    {
        return $this->calculated;
    }

    public function setCalculated(?\DateTimeInterface $calculated): static
    {
        $this->calculated = $calculated;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
