<?php

namespace App\Entity;

use App\Repository\DailyQuizLimitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DailyQuizLimitRepository::class)]
class DailyQuizLimit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $quiz_date = null;

    #[ORM\Column(nullable: true)]
    private ?int $quizCount = null;

    #[ORM\ManyToOne(inversedBy: 'dailyQuizLimits')]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuizDate(): ?\DateTimeInterface
    {
        return $this->quiz_date;
    }

    public function setQuizDate(?\DateTimeInterface $quiz_date): static
    {
        $this->quiz_date = $quiz_date;

        return $this;
    }

    public function getQuizCount(): ?int
    {
        return $this->quizCount;
    }

    public function setQuizCount(?int $quizCount): static
    {
        $this->quizCount = $quizCount;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
