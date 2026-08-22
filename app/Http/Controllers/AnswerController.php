<?php

namespace App\Http\Controllers;

use App\Contracts\AnswerServiceInterface;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    protected AnswerServiceInterface $answerService;

    public function __construct(AnswerServiceInterface $answerService)
    {
        $this->answerService = $answerService;
    }

    /**
     * Store a newly created answer resource.
     */
    public function store(StoreAnswerRequest $request, Question $question)
    {
        if (! $this->answerService->canUserPostAnswer(auth()->id(), $question->id)) {
            return back()->with('error', 'لا يمكنك الإجابة على سؤالك الخاص');
        }

        $answer = $this->answerService->createAnswer($request->validated(), $question->id, auth()->id());

        return redirect()
            ->route('questions.show', $question)
            ->with('success', 'تم إضافة الإجابة بنجاح');
    }

    /**
     * Accept an answer as the correct solution.
     */
    public function accept(Answer $answer)
    {
        $this->authorize('accept', $answer);

        $this->answerService->reputationService->awardForAcceptedAnswer($answer);

        return back()->with('success', 'تم اعتماد الإجابة و منحت صاحبها 10 نقاط');
    }
}
