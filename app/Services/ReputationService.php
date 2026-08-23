<?php

namespace App\Services;

use App\Contracts\ReputationServiceInterface;
use App\Models\Answer;
use App\Models\ReputationLog;

class ReputationService implements ReputationServiceInterface
{
    public function awardForAcceptedAnswer(Answer $answer): void
    {
        $answer->update(['is_accepted' => true]);
        $answer->post()->update(['is_solved' => true]);
        $answer->user->increment('reputation_points', 10);
        ReputationLog::create([
            'user_id' => $answer->user_id,
            'points' => 10,
            'reason' => 'تم اعتماد إجابته كحل للسؤال: '.$answer->post->title,
        ]);
    }
}
