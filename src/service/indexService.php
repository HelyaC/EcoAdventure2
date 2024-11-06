<?php
// src/Service/IndexService.php

namespace App\service;

use App\Entity\DailyQuizLimit;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class indexService
{
    const DAILY_QUIZ_LIMIT = 5; // Exemple de limite quotidienne

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function hasReachedDailyLimit(User $user): bool
    {
        $today = new DateTime();

        // Rechercher un enregistrement de DailyQuizLimit pour cet utilisateur aujourd'hui
        $dailyLimit = $this->entityManager->getRepository(DailyQuizLimit::class)->findOneBy([
            'user' => $user,
            'quizDate' => $today,
        ]);

        // Vérifier si la limite quotidienne est atteinte
        return $dailyLimit && $dailyLimit->getQuizCount() >= self::DAILY_QUIZ_LIMIT;
    }
}
