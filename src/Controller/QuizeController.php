<?php

namespace App\Controller;

use App\Requests\AnswerQuestionRequest;
use App\Services\QuizeServiceInterface;
use App\Services\ResultServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuizeController extends AbstractController
{
    public function __construct(
        private readonly QuizeServiceInterface $quizeService,
        private readonly ResultServiceInterface $resultService,
    ) {}

    public function index(Request $request): Response
    {
        $previousIds = $request->getSession()->get('answers', []);
        $question = $this->quizeService->getQuestion($previousIds);

        if ($question === null) {
            return new RedirectResponse(
                $this->generateUrl('quize.results'),
            );
        }

        return $this->render('quize.html.twig', [
            'question' => $question,
        ]);

    }

    public function answerQuestion(Request $request): Response
    {
        $answerQuestionRequest = new AnswerQuestionRequest(
            id: $request->get('id'),
            options: $request->get('options')
                ? array_keys($request->get('options'))
                : [],
        );
        $session = $request->getSession();

        $resultId = $session->get('result_id');

        if($resultId === null) {
            $resultId = $this->resultService->initNewResult();
            $session->set('result_id', $resultId);
        }
        $previousIds = array_merge(
            $session->get('answers', []),
            [$answerQuestionRequest->id],
        );
        $session->set('answers', $previousIds);

        $this->resultService->addQuestionAnswer(
            $resultId,
            $answerQuestionRequest,
        );

        $question = $this->quizeService->getQuestion($previousIds);

        if ($question === null) {
            return new RedirectResponse(
                $this->generateUrl('quize.results'),
            );
        }

        return $this->render('quize.html.twig', [
            'question' => $question,
        ]);

    }

    public function clear(Request $request): Response
    {
        $request->getSession()->clear();
        return new RedirectResponse(
            $this->generateUrl('quize.question'),
        );
    }

    public function showResults(Request $request): Response
    {
        $session = $request->getSession();
        $resultId = $session->get('result_id');
        $results = $this->resultService->getResult($resultId);

        return $this->render('results.html.twig', [
            'result' => $results,
        ]);
    }
}