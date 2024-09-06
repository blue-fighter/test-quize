<?php

namespace App\DTO\Frontend;

final class ResultDTO
{
    /**
     * @param ResultAnswerDTO[] $answers
     */
    public function __construct(
        public readonly int $id,
        public ?array $answers,
    ) {
        $this->answers = $answers !== null
            ? $this->deserializeAnswers($this->answers)
            : null;
    }

    public function serializeAnswers(): array
    {
        return array_map(
                fn($answer) => $answer->serialize(),
                $this->answers,
            );
    }

    public function deserializeAnswers(array $data): array
    {
        return array_map(
            fn($option) => ResultAnswerDTO::deserialize($option),
            $data,
        );
    }
}