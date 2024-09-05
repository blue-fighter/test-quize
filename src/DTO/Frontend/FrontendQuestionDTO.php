<?php

namespace App\DTO\Frontend;

final readonly class FrontendQuestionDTO
{
    /**
     * @param FrontendQuestionOptionDTO[] $options
     */
    public function __construct(
        public int $id,
        public string $text,
        public array $options,
    ) {}
}