<?php

namespace App\DTO\Frontend;

final readonly class ResultAnswerOptionDTO
{
    public function __construct(
        public int $id,
        public string $text,
        public bool $isSelected,
    ) {}

    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'isSelected' => $this->isSelected,
        ];
    }

    public static function deserialize(\stdClass $data): self
    {
        return new self(
            id: $data->id,
            text: $data->text,
            isSelected: $data->isSelected,
        );
    }
}