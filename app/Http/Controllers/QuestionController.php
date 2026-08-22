<?php

namespace App\Http\Controllers;

use App\Contracts\QuestionServiceInterface;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    protected QuestionServiceInterface $questionService;

    public function __construct(QuestionServiceInterface $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionService->getAllQuestions();

        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $question = $this->questionService->createQuestion($data, $request->file('image')?->store('questions', 'public'));

        return redirect()->route('questions.show', $question)->with('success', 'تم طرح السؤال بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }
}
