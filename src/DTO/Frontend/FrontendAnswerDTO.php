<?php

namespace App\DTO\Frontend;

final readonly class FrontendAnswerDTO
{
    public function __construct(
        public string $questionText,
        public string $isCorrectAnswer,
    ) {}

    public static function deserialize(\stdClass $data): self
    {
        return new self(
            questionText: $data->questionText,
            isCorrectAnswer: $data->isCorrectAnswer ? 'Yes' : 'No',
        );
    }

}