<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Question\QuestionCreateRequest;
use App\Http\Requests\Dashboard\Question\QuestionUpdateRequest;
use App\Services\Dashboard\QuestionService;
use App\Services\Dashboard\QuizService;
use Exception;

class QuestionController extends Controller
{
    /**
     * @var QuestionService
     */
    private $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionService->list();
        return view('dashboard.pages.quizzes.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($quizId)
    {
        return view('dashboard.pages.quizzes.questions.create', compact('quizId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionCreateRequest $request)
    {
        try {
            $question = $this->questionService->store($request->validated());
            return redirect()->route('admin.quiz.questions', $question->quiz_id)
                ->with('success', 'Question created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.quizzes.questions.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $quizId)
    {
        $quiz = $this->questionService->findById($quizId);
        return view('dashboard.pages.quizzes.questions.update', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionUpdateRequest $request)
    {
        try {
            $quiz = $this->questionService->update($request->validated());
            return redirect()->route('admin.course.quizzes', $quiz->course_id)
                ->with('success', 'Question created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = $this->questionService->findById($id);
        try {
            $this->questionService->destroy($quiz);
            return redirect()->route('admin.course.quizzes', $quiz->course_id)
                ->with('success', 'Question deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.course.quizzes', $quiz->course_id)->with('error', $e->getMessage());
        }
    }

    /**
     * Display the answers of specific question.
     */
    public function showQuestionAnswers(string $quizId)
    {
        $questions = $this->questionService->showQuestionAnswers($quizId);
        return view('dashboard.pages.quizzes.questions.questions.index', compact(
            'questions',
            'quizId'
        ));
    }
}
