<?php

namespace App\DTO\Frontend;

final class FrontendResultDTO
{
    /**
     * @param FrontendResultDTO[] $answers
     */
    public function __construct(
        public readonly int $id,
        public ?array $answers,
    ) {
        $this->answers = $answers !== null
            ? $this->deserializeAnswers($this->answers)
            : null;
    }


    public function deserializeAnswers(array $data): array
    {
        return array_map(
            fn($option) => FrontendAnswerDTO::deserialize($option),
            $data,
        );
    }
}