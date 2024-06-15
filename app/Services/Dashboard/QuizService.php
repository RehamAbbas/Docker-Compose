<?php

namespace App\Services\Dashboard;

use App\Models\Quiz;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class QuizService
{
    public function list(): Collection
    {
        $quizzes = Quiz::all();
        return $quizzes;
    }

    public function store(array $data): Quiz
    {
        $quiz = Quiz::create($data);
        return $quiz;
    }

    public function update(array $data): Quiz
    {
        $quiz = $this->findById($data['id']);

        $quiz->update($data);

        return $quiz->fresh();
    }

    public function findById(int $id): Quiz
    {
        $quiz = Quiz::findOrFail($id);
        return $quiz;
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
    }

    public function showQuizQuestions(string $id)
    {
        $quiz = $this->findById($id);
        return $quiz->questions;
    }
}
