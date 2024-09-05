<?php

namespace App\Controller;

use App\DTO\Frontend\FrontendQuestionDTO;
use App\DTO\Frontend\FrontendQuestionOptionDTO;
use App\Requests\AnswerQuestionRequest;
use App\Services\QuizeServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class QuizeController extends AbstractController
{
    public function __construct(
        private readonly QuizeServiceInterface $quizeService,
    ) {}

    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $answers = $session->get('answers', []);
        $question = $this->quizeService->getQuestion($answers);

        if ($question === null) {
            return new Response('Finish');
        }

        return $this->render('quize.html.twig', [
            'question' => $question,
        ]);

    }

    public function answerQuestion(Request $request)
    {
        $answerQuestionRequest = new AnswerQuestionRequest(
            id: $request->get('id'),
            options: $request->get('options', []),
        );

        $session = $request->getSession();
        $answers = array_merge(
            $session->get('answers', []),
            [$answerQuestionRequest->id],
        );
        $session->set('answers', $answers);

        $question = $this->quizeService->getQuestion($answers);

        if ($question === null) {
            return new Response('Finish');
        }

        return $this->render('quize.html.twig', [
            'question' => $this->quizeService->getQuestion($answers),
        ]);
    }

    public function clear(Request $request): Response
    {
        $request->getSession()->clear();
        return new RedirectResponse(
            $this->generateUrl('quize.question'),
        );
    }
}