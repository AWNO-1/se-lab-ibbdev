<?php

namespace App\Services;

use App\Contracts\AnswerServiceInterface;
use App\Contracts\ReputationServiceInterface;
use App\Models\Answer;
use App\Models\Question;

class AnswerService implements AnswerServiceInterface
{
    protected ReputationServiceInterface $reputationService;

    public function __construct(ReputationServiceInterface $reputationService)
    {
        $this->reputationService = $reputationService;
    }

    public function createAnswer(array $data, int $questionId, int $userId): Answer
    {
        $question = Question::find($questionId);

        if (! $question || $question->user_id == $userId) {
            throw new \Exception('Cannot post answer to own question');
        }

        $answer = Answer::create([
            'question_id' => $questionId,
            'user_id' => $userId,
            'body' => $data['body'],
        ]);

        return $answer;
    }

    public function canUserAccept(int $userId, int $answerId): bool
    {
        $answer = Answer::with('question.user')->find($answerId);

        return $answer && $answer->question->user_id == $userId;
    }

    public function canUserPostAnswer(int $userId, int $questionId): bool
    {
        $question = Question::find($questionId);

        return $question && $question->user_id != $userId;
    }
}
