<?php

namespace App\Services;

use App\DTO\Frontend\FrontendResultDTO;
use App\DTO\Frontend\ResultAnswerOptionDTO;
use App\DTO\Frontend\ResultDTO;
use App\DTO\Frontend\ResultAnswerDTO;
use App\Entity\Question;
use App\Entity\QuestionOption;
use App\Entity\Result;
use App\Requests\AnswerQuestionRequest;
use Doctrine\ORM\EntityManagerInterface;

class ResultService implements ResultServiceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    public function initNewResult(): int
    {
        $result = new Result();
        $this->entityManager->persist($result);
        $this->entityManager->flush();

        return $result->getId();
    }

    public function addQuestionAnswer(int $resultId, AnswerQuestionRequest $resultQuestionDTO): void
    {
        $result = $this->entityManager->getRepository(Result::class)->find($resultId);
        $resultDTO = new ResultDTO(
            id: $result->getId(),
            answers: json_decode($result->getData()),
        );

        $newAnswer = $this->resolveAnswer($resultQuestionDTO);
        $resultDTO->answers[] = $newAnswer;
        $result->setData(json_encode($resultDTO->serializeAnswers()));
        $this->entityManager->flush();
    }

    public function getResult(int $resultId): FrontendResultDTO
    {
        $result = $this->entityManager->getRepository(Result::class)->find($resultId);
        $resultDTO = new FrontendResultDTO(
            id: $result->getId(),
            answers: json_decode($result->getData()),
        );

        return $resultDTO;
    }

    private function resolveAnswer(AnswerQuestionRequest $resultQuestionDTO): ResultAnswerDTO
    {
        $question = $this->entityManager->getRepository(Question::class)->find($resultQuestionDTO->id);
        $optionObjects = $this->entityManager->getRepository(QuestionOption::class)->findBy([
            'questionId' => $resultQuestionDTO->id,
        ]);

        $correctOptionIds = array_map(
            fn($option) => $option->getId(),
            array_filter(
                $optionObjects,
                fn($option) => $option->getIsCorrectAnswer(),
            ),
        );

        $wrongAnswers = array_filter(
            $resultQuestionDTO->options,
            fn($userAnswer) => !in_array($userAnswer, $correctOptionIds),
        );

        return new ResultAnswerDTO(
            id: $resultQuestionDTO->id,
            questionText: $question->getText(),
            isCorrectAnswer: empty($wrongAnswers),
            options: array_map(fn($option) => new ResultAnswerOptionDTO(
                id: $option->getId(),
                text: $option->getText(),
                isSelected: in_array(
                    $option->getId(),
                    $resultQuestionDTO->options,
                ),
            ),
                $optionObjects),
        );
    }
}