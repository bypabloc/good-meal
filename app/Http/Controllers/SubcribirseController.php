<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcribirseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkEmail(Request $request)
    {
        $validated = $request->validate([
            // 'title' => 'required|unique:posts|max:255',
            'email' => 'required|email|max:255',
        ]);

        $true_false = [true,false];
        $random = random_int(0, 1);

        return [
            'data' => [
                'validate' => $true_false[$random],
            ],
        ];
    }
}
