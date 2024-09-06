<?php

namespace App\DTO\Frontend;

final readonly class ResultAnswerDTO
{
    /**
     * @param ResultAnswerOptionDTO[] $options
     */
    public function __construct(
        public int $id,
        public string $questionText,
        public bool $isCorrectAnswer,
        public array $options,
    ) {}


    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'questionText' => $this->questionText,
            'isCorrectAnswer' => $this->isCorrectAnswer,
            'options' => array_map(
                fn($option) => $option->serialize(),
                $this->options,
            ),
        ];
    }

    public static function deserialize(\stdClass $data): self
    {
        return new self(
            id: $data->id,
            questionText: $data->questionText,
            isCorrectAnswer: $data->isCorrectAnswer,
            options: array_map(
                fn($option) => ResultAnswerOptionDTO::deserialize($option),
                $data->options,
            ),
        ) ;
    }

}