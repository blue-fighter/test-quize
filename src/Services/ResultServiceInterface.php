<?php

namespace App\Services;

use App\DTO\Frontend\FrontendResultDTO;
use App\Requests\AnswerQuestionRequest;

interface ResultServiceInterface
{
    public function initNewResult(): int;
    public function addQuestionAnswer(int $resultId, AnswerQuestionRequest $resultQuestionDTO): void;
    public function getResult(int $resultId): FrontendResultDTO;
}