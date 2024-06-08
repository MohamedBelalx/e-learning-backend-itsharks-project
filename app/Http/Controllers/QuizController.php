<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
class QuizController extends Controller
{
    // Read all Quizes Function // 

    public function all()
    {
        return response()->json(Quiz::all());
    }


    // Create New Quiz Fundtion // 

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|integer|exists:teachers,id',
            'course_id' => 'required|integer|exists:courses,id',
            'title' => 'required|string|max:255',
            'question' => 'required|string', // Assuming there might be multiple questions handled differently
            'score' => 'required|integer'
        ]);

        $quiz = Quiz::create([
            'teacher_id' => $request->teacher_id,
            'course_id' => $request->course_id,
            'title' => $request->title,
            'question' => $request->question,
            'score' => $request->score
        ]);

        return response()->json([
            'message' => 'Quiz created successfully',
            'data' => $quiz
        ], 201);
    }


    // Review Course details function // 

    public function show($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        return response()->json($quiz);
    }

    // Update Quiz details function // 

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'integer|exists:teachers,id',
            'course_id' => 'integer|exists:courses,id',
            'title' => 'string|max:255',
            'question' => 'string',
            'score' => 'integer'
        ]);

        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $quiz->update($request->all());

        return response()->json([
            'message' => 'Quiz updated successfully',
            'data' => $quiz
        ]);
    }


    // Delete course function // 

    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['message' => 'Quiz not found'], 404);
        }

        $quiz->delete();

        return response()->json(['message' => 'Quiz deleted successfully']);
    }

}
