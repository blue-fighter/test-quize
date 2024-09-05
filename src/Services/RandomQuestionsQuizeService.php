<?php

namespace App\Services;

use App\DTO\Frontend\FrontendQuestionDTO;
use App\DTO\Frontend\FrontendQuestionOptionDTO;
use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;

final readonly class RandomQuestionsQuizeService implements QuizeServiceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    /**
     * @param int[] $previousIds
     */
    public function getQuestion(array $previousIds = []): ?FrontendQuestionDTO
    {
        $repository = $this->entityManager->getRepository(Question::class);
        $questionIds = $repository->getAllIds();

        if (!empty($previousIds)) {
            $questionIds = array_filter(
                array_flip($questionIds),
                fn($id) => !in_array($id, $previousIds),
                ARRAY_FILTER_USE_KEY,
            );
        }

        if(empty($questionIds)) {
            return null;
        }

        $question = $repository->find(array_rand($questionIds));
        return new FrontendQuestionDTO(
            id: $question->getId(),
            text: $question->getText(),
            options: array_map(
                fn($opt) => new FrontendQuestionOptionDTO($opt->getId(), $opt->getText()),
                $question->getOptions()->toArray(),

            ),
        );
    }
}