<?php

namespace App\Controller;

use Google\Client;
use Google\Service\Sheets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class QuizController extends AbstractController
{
    #[Route('/quiz', name: 'app_quiz')]
    public function index(Request $request): Response
    {
        $number = $request->query->get('number');
        return $this->render('quiz/index.html.twig', [
            'number' => $number,
        ]);
    }

    #[Route('/quiz-score', name:'app_quiz_score')]
    public function score(Request $request): Response
{
    $id = $request->query->get('sid');
    $client = new \Google_Client();
    $client->setApplicationName('Google Sheets API');
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAccessType('offline');
    $path = './../assets/credentials.json';
    $client->setAuthConfig($path);

    $service = new \Google_Service_Sheets($client);
    $spreadsheetId = $id;
    $range = 'Réponses au formulaire 1!B2';
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
    if ($values != null) {
        $score = $values[0][0];
        list($score,$total) = explode('/', $score);
        $score = intval($score);
        $message = 'Félicitations! Vous avez obtenu un score de ' . $score;

        // Suppression de la ligne 2 après l'affichage du score
        $sheetId = $service->spreadsheets->get($spreadsheetId)->getSheets()[0]->getProperties()->getSheetID(); // Remplacez par l'ID de votre onglet si nécessaire
        $ligneASupprimer = 2;

        // Préparer la requête pour supprimer la ligne
        $requestBody = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => [
                'deleteDimension' => [
                    'range' => [
                        'sheetId' => $sheetId,
                        'dimension' => 'ROWS',
                        'startIndex' => $ligneASupprimer - 1, // Convertir en index 0
                        'endIndex' => $ligneASupprimer // La ligne à supprimer (non inclusif)
                    ]
                ]
            ]
        ]);
        $service->spreadsheets->batchUpdate($spreadsheetId, $requestBody);
        
        if (isset($_COOKIE["score"])) {
            $_COOKIE["score"] = $_COOKIE["score"] + $score;
            setcookie("score", $_COOKIE["score"], time() + (365 * 24 * 60 * 60), "/");
        } else {
            setcookie("score", $score, time() + (365 * 24 * 60 * 60), "/");
        }
    } else {
        $message = 'Merci de répondre à tous les questions pour calculer votre score';
    }

    return $this->redirectToRoute('app_index');
    // return new Response($_COOKIE["score"].' '.$score." Old :".$cookieOld.' '.$scoreOld);
}
}
