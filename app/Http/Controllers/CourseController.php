<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function all()
    {
        return response()->json(Course::all());
    }

    // create new course function // 

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'is_approved' => 'required|boolean',
            'price' => 'required|numeric',
            'lang' => 'required|string|max:10',
            'teacher_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'is_approved' => $request->is_approved,
            'price' => $request->price,
            'lang' => $request->lang,
            'teacher_id' => $request->teacher_id,
            'category_id' => $request->category_id
        ]);

        return response()->json([
            'message' => 'Course created successfully',
            'data' => $course
        ], 201);
    }


    // Review course function // 

    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        return response()->json($course);
    }


    // update course function // 

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'duration' => 'integer',
            'is_approved' => 'boolean',
            'price' => 'numeric',
            'lang' => 'string|max:10',
            'teacher_id' => 'integer|exists:users,id',
            'category_id' => 'integer|exists:categories,id'
        ]);

        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->update($request->all());

        return response()->json([
            'message' => 'Course updated successfully',
            'data' => $course
        ]);
    }

    // delete course function // 

    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course deleted successfully']);
    }


    // search function //

    public function search(Request $request)
    {
        $query = Course::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('price')) {
            $query->where('price', $request->price);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }

        if ($request->filled('teacher')) {
            $query->whereHas('teacher', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->teacher . '%');
            });
        }

        $courses = $query->with('category', 'teacher')->get();

        return response()->json($courses);
    }
}



