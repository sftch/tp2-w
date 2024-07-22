<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function getStatus()
    {
        // Query to get completed and non-completed todos
        $completedTodos = Todo::where('completed', 1)->count();
        $notCompletedTodos = Todo::where('completed', 0)->count();
        $deletedTodos = Todo::onlyTrashed()->count();

        // Prepare data for the chart
        $data = [
            'labels' => ['Completed', 'Not Completed', 'Deleted'],
            'values' => [$completedTodos, $notCompletedTodos, $deletedTodos],
            'backgroundColor' => [
                'rgb(75, 192, 192)',  // Completed - Green
                'rgb(54, 162, 235)',  // Not Completed - Blue
                'rgb(255, 99, 132)'   // Deleted - Red
            ]
        ];

        return response()->json($data);
    }
}
