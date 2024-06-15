<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Quiz\QuizCreateRequest;
use App\Http\Requests\Dashboard\Quiz\QuizUpdateRequest;
use App\Services\Dashboard\QuizService;
use Exception;

class QuizController extends Controller
{
    /**
     * @var QuizService
     */
    private $quizService;

    public function __construct(QuizService $quizService)
    {
        $this->quizService = $quizService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = $this->quizService->list();
        return view('dashboard.pages.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId)
    {
        return view('dashboard.pages.quizzes.create', compact('courseId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizCreateRequest $request)
    {
        try {
            $quiz = $this->quizService->store($request->validated());
            return redirect()->route('admin.course.quizzes', $quiz->course_id)
                ->with('success', 'Quiz created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.pages.quizzes.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $quizId)
    {
        $quiz = $this->quizService->findById($quizId);
        return view('dashboard.pages.quizzes.update', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizUpdateRequest $request)
    {
        try {
            $quiz = $this->quizService->update($request->validated());
            return redirect()->route('admin.course.quizzes', $quiz->course_id)->with('success', 'Quiz created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = $this->quizService->findById($id);
        try {
            $this->quizService->destroy($quiz);
            return redirect()->route('admin.course.quizzes', $quiz->course_id)
                ->with('success', 'Quiz deleted successfully.');
        } catch (Exception $e) {
            return redirect()->route('admin.course.quizzes', $quiz->course_id)->with('error', $e->getMessage());
        }
    }

    /**
     * Display the questions of specific quiz.
     */
    public function showQuizQuestions(string $quizId)
    {
        $questions = $this->quizService->showQuizQuestions($quizId);
        return view('dashboard.pages.quizzes.questions.index', compact(
            'questions',
            'quizId'
        ));
    }
}
