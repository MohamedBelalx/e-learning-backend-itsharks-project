<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');
        $type = $request->get('type');  

        $results = [];

        if ($type === 'users' || $type === 'all') {
            $results['users'] = User::where('name', 'like', "%{$query}%")
                                ->orWhere('email', 'like', "%{$query}%")
                                ->get();
        }

        if ($type === 'courses' || $type === 'all') {
            $results['courses'] = Course::where('title', 'like', "%{$query}%")
                                    ->orWhere('description', 'like', "%{$query}%")
                                    ->get();
        }

        if ($type === 'categories' || $type === 'all') {
            $results['categories'] = Category::where('name', 'like', "%{$query}%")
                                        ->get();
        }

        return response()->json($results);
    }
}
