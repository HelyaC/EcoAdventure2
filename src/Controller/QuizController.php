<?php
// src/Controller/QuizController.php
namespace App\Controller;

use App\Entity\QuizQuestion;
use App\Entity\UserQuiz;
use App\Entity\DailyQuizLimit;
//use App\Repository\QuizQuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

class QuizController extends AbstractController
{
    private const DAILY_QUIZ_LIMIT = 3;

    #[Route('/quiz', name: 'quiz_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if ($this->hasReachedDailyLimit($user, $entityManager)) {
            return $this->render('quiz/limit_reached.html.twig', [
                'message' => "Vous avez atteint votre limite quotidienne de quiz.",
            ]);
        }

        // Récupère une question aléatoire pour l'utilisateur
        $question = $entityManager->getRepository(QuizQuestion::class)->findRandomQuestion();
        
        return $this->render('quiz/index.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/quiz/submit', name: 'quiz_submit', methods: ['POST'])]
    public function submit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        if ($this->hasReachedDailyLimit($user, $entityManager)) {
            return $this->redirectToRoute('quiz_index');
        }

        $questionId = $request->request->get('question_id');
        $selectedAnswer = $request->request->get('selected_answer');
        $question = $entityManager->getRepository(QuizQuestion::class)->find($questionId);

        $userQuiz = new UserQuiz();
        $userQuiz->setUser($user);
        $userQuiz->setQuizQuestion($question);
        $userQuiz->setSelectedAnswer($selectedAnswer);
        $userQuiz->setCorrect($selectedAnswer === $question->getCorrectAnswer());

        $entityManager->persist($userQuiz);

        // Mise à jour du compteur de quiz dans DailyQuizLimit
        $this->incrementDailyQuizCount($user, $entityManager);

        $entityManager->flush();

        return $this->redirectToRoute('quiz_index');
    }

    private function hasReachedDailyLimit($user, EntityManagerInterface $entityManager): bool
    {
        $today = new DateTime();
        
        $dailyLimit = $entityManager->getRepository(DailyQuizLimit::class)->findOneBy([
            'user' => $user,
            'quizDate' => $today,
        ]);

        return $dailyLimit && $dailyLimit->getQuizCount() >= self::DAILY_QUIZ_LIMIT;
    }

    private function incrementDailyQuizCount($user, EntityManagerInterface $entityManager): void
    {
        $today = new DateTime();
        
        $dailyLimit = $entityManager->getRepository(DailyQuizLimit::class)->findOneBy([
            'user' => $user,
            'quizDate' => $today,
        ]);

        if (!$dailyLimit) {
            $dailyLimit = new DailyQuizLimit();
            $dailyLimit->setUser($user);
            $dailyLimit->setQuizDate($today);
            $dailyLimit->setQuizCount(1);
        } else {
            $dailyLimit->setQuizCount($dailyLimit->getQuizCount() + 1);
        }

        $entityManager->persist($dailyLimit);
    }
}