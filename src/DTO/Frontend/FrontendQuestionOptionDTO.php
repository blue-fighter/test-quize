<?php

namespace App\DTO\Frontend;

final readonly class FrontendQuestionOptionDTO
{
    public function __construct(
        public int $id,
        public string $text,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

}