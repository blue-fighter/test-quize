<?php

namespace App\Requests;

final readonly class AnswerQuestionRequest
{
    public function __construct(
        public int $id,
        public array $options,
    ) {}
}