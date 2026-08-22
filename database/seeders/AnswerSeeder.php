<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'saherqaid2020@gmail.com')->first();
        $questions = Question::all();

        if (! $user || $questions->isEmpty()) {
            return;
        }

        // Create answers for each question
        foreach ($questions as $question) {
            // Create 2-3 answers per question
            $answerCount = random_int(2, 3);

            for ($i = 0; $i < $answerCount; $i++) {
                $answerer = User::inRandomOrder()->first();

                // Make sure the answerer is not the question owner
                if ($answerer->id === $question->user_id) {
                    $answerer = User::where('id', '!=', $question->user_id)->first();
                }

                Answer::create([
                    'question_id' => $question->id,
                    'user_id' => $answerer->id,
                    'body' => fake()->sentence(),
                    'is_accepted' => random_bool(0.3), // 30% chance of being accepted
                ]);
            }
        }

        // Make sure the saher user has at least one accepted answer
        $saherQuestion = $questions->first();
        if ($saherQuestion && $user) {
            // Find an answer from another user to this question
            $otherAnswer = Answer::where('question_id', $saherQuestion->id)
                ->where('user_id', '!=', $user->id)
                ->first();

            if ($otherAnswer) {
                $otherAnswer->update(['is_accepted' => true]);
                // Add 10 reputation points to the answer owner
                $otherAnswer->user->increment('reputation_points', 10);
            }
        }
    }
}
