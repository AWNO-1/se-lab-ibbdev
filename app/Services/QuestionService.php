<?php

namespace App\Services;

use App\Contracts\QuestionServiceInterface;
use App\Contracts\ReputationServiceInterface;
use App\Models\Question;
use Illuminate\Database\Eloquent\Collection;

class QuestionService implements QuestionServiceInterface
{
    protected ReputationServiceInterface $reputationService;

    public function __construct(ReputationServiceInterface $reputationService)
    {
        $this->reputationService = $reputationService;
    }

    public function createQuestion(array $data, ?string $imagePath = null): Question
    {
        $question = Question::create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'body' => $data['body'],
            'image' => $imagePath,
        ]);

        return $question;
    }

    public function getAllQuestions(): Collection
    {
        return Question::with('user')->latest()->get();
    }

    public function getQuestionWithRelations(int $id): ?Question
    {
        return Question::with('user', 'answers')->find($id);
    }

    public function canUserAnswer(int $userId, int $questionId): bool
    {
        $question = Question::find($questionId);

        return $question && $question->user_id !== $userId;
    }
}
