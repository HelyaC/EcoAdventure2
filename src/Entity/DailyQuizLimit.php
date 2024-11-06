<?php

namespace App\Entity;

use App\Repository\DailyQuizLimitRepository;
//use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: DailyQuizLimitRepository::class)]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'dailyQuizLimits')]

class DailyQuizLimit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'dailyQuizLimits')]
    #[ORM\JoinColumn(nullable: false)]

    private $id ;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(type: 'date')]
    private $quizDate;

    #[ORM\Column(type: 'integer')]
    private $quizCount;

    // Getters et setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getQuizDate(): ?\DateTimeInterface
    {
        return $this->quizDate;
    }

    public function setQuizDate(\DateTimeInterface $quizDate): self
    {
        $this->quizDate = $quizDate;
        return $this;
    }

    public function getQuizCount(): ?int
    {
        return $this->quizCount;
    }

    public function setQuizCount(int $quizCount): self
    {
        $this->quizCount = $quizCount;
        return $this;
    }
}