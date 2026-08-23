<?php

namespace App\Services;

use App\Contracts\AnswerServiceInterface;
use App\Contracts\ReputationServiceInterface;
use App\Models\Answer;
use App\Models\Post;

class AnswerService implements AnswerServiceInterface
{
    public ReputationServiceInterface $reputationService;

    public function __construct(ReputationServiceInterface $reputationService)
    {
        $this->reputationService = $reputationService;
    }

    public function createAnswer(array $data, int $postId, int $userId): Answer
    {
        $post = Post::find($postId);

        if (! $post || $post->user_id == $userId) {
            throw new \Exception('Cannot post answer to own post');
        }

        $answer = Answer::create([
            'post_id' => $postId,
            'user_id' => $userId,
            'body' => $data['body'],
        ]);

        return $answer;
    }

    public function canUserAccept(int $userId, int $answerId): bool
    {
        $answer = Answer::with('post.user')->find($answerId);

        return $answer && $answer->post->user_id == $userId;
    }

    public function canUserPostAnswer(int $userId, int $postId): bool
    {
        $post = Post::find($postId);

        return $post && $post->user_id != $userId;
    }
}
