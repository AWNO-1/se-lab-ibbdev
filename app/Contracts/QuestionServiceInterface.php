<?php

namespace App\Contracts;

use App\Models\Question;
use Illuminate\Eloquent\Collection;

interface QuestionServiceInterface
{
    public function createQuestion(array $data, ?string $imagePath = null): Question;

    public function getAllQuestions(): Collection;

    public function getQuestionWithRelations(int $id): ?Question;

    public function canUserAnswer(int $userId, int $questionId): bool;
}
