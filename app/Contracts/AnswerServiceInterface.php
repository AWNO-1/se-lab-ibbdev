<?php

namespace App\Contracts;

use App\Models\Answer;

interface AnswerServiceInterface
{
    public function createAnswer(array $data, int $postId, int $userId): Answer;

    public function canUserAccept(int $userId, int $answerId): bool;

    public function canUserPostAnswer(int $userId, int $postId): bool;
}
