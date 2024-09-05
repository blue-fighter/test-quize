<?php

namespace App\Services;

use App\DTO\Frontend\FrontendQuestionDTO;

interface QuizeServiceInterface
{
    public function getQuestion(array $previousIds = []): ?FrontendQuestionDTO;
}