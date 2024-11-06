<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Entity\QuizQuestion;

#[ORM\Entity]
class UserQuiz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: QuizQuestion::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $quizQuestion;

    #[ORM\Column(type: 'string', length: 255)]
    private $selectedAnswer;

    #[ORM\Column(type: 'boolean')]
    private $correct;

    #[ORM\Column(type: 'datetime')]
    private $completedAt;

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

    public function getQuizQuestion(): ?QuizQuestion
    {
        return $this->quizQuestion;
    }

    public function setQuizQuestion(?QuizQuestion $quizQuestion): self
    {
        $this->quizQuestion = $quizQuestion;
        return $this;
    }

    public function getSelectedAnswer(): ?string
    {
        return $this->selectedAnswer;
    }

    public function setSelectedAnswer(string $selectedAnswer): self
    {
        $this->selectedAnswer = $selectedAnswer;
        return $this;
    }

    public function isCorrect(): ?bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): self
    {
        $this->correct = $correct;
        return $this;
    }

    public function getCompletedAt(): ?\DateTimeInterface
    {
        return $this->completedAt;
    }

    public function setCompletedAt(\DateTimeInterface $completedAt): self
    {
        $this->completedAt = $completedAt;
        return $this;
    }
}